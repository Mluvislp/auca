<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Functions\MyHelper;
use App\Http\Requests\Archive\CreateArchiveRequest;
use App\Http\Requests\Archive\UpdateArchiveRequest;
use App\Models\Warehouse;
use App\Models\WarehouseProductArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class WarehouseProductArchiveController extends Controller {
    public function getAllWareHouseArchive( Request $req ){
        try{
            $perPage    = $req->input( 'per_page' , 10 );
            $all_search = $req->all();
            $query      = WarehouseProductArchive::query();
            $query      = $this->handleFilter( $query , $all_search );
            $list = $query->with( 'warehouseProduct' )->with( 'product' )->with( 'user' )->paginate( $perPage );
            dd($list);
            $data = [
                'data'         => collect( $list->items() )->map( function( $list ){
                    $list->view_id_and_time          = $list->wb_id.'<br>'.timeStampToDate( $list->created_at );
                    $warehouse                       = '';
                    $des                             = '';
                    $list->view_warehouse            = $warehouse.'<br>'.$des;
                    $list->view_total_product        = 0;
                    $list->view_quantity_product     = 0;
                    $list->view_total_money          = 0;
                    $list->view_total_discount_value = 0;
                    foreach( $list->wareHouseBillProduct as $bill_product ){
                        $list->view_total_product        = $list->view_total_product + 1;
                        $list->view_quantity_product     = $list->view_quantity_product + $bill_product->wbp_quantity;
                        $list->view_total_money          = $list->view_total_money + $bill_product->wbp_price;
                        $list->view_total_discount_value = $list->view_total_discount_value + $bill_product->wbp_discount_money;
                    }
                    $list->view_total_money = $list->view_total_money - $list->view_total_discount_value;
                    $list->view_user_name   = $list->user ? $list->user->user_name : "---";
                    unset( $list->user );
                    $list->view_description = $list->wb_description;
                    return $list;
                } ) ,
                'total'        => $list->total() ,
                'per_page'     => $list->perPage() ,
                'current_page' => $list->currentPage() ,
            ];
            return MyHelper::response( true , 'Successfully' , $data , 200 );
        }catch( \Exception $e ){
            return MyHelper::response( false , 'Không thể lấy dữ liệu' , [] , 404 );
        }
    }

    public function handleFilter( $query , $all_search ){
        if( array_key_exists( 'filter_w_id' , $all_search ) && !empty( $all_search[ 'filter_w_id' ] ) ){
            $query->where( 'w_id' , $all_search[ 'filter_w_id' ] );
        }
        if( array_key_exists( 'filter_created_from' , $all_search ) && !empty( $all_search[ 'filter_created_from' ] ) ){
            $query->where( 'created_at' , '>=' , dateToTimeStamp( $all_search[ 'filter_created_from' ] ) );
        }
        if( array_key_exists( 'filter_created_to' , $all_search ) && !empty( $all_search[ 'filter_created_to' ] ) ){
            $query->where( 'created_at' , '<=' , dateToTimeStamp( $all_search[ 'filter_created_to' ] ) );
        }
        if( array_key_exists( 'filter_prd_id' , $all_search ) && !empty( $all_search[ 'filter_prd_id' ] ) ){
            $query->whereHas( 'product' , function( $query ) use ( $all_search ){
                $query->where( 'prd_id' , $all_search[ 'filter_prd_id' ] );
            } );
        }
        if( array_key_exists( 'filter_cat_id' , $all_search ) && !empty( $all_search[ 'filter_cat_id' ] ) ){
            $query->whereHas( 'product' , function( $query ) use ( $all_search ){
                $query->where( 'cat_id' , $all_search[ 'filter_cat_id' ] );
            } );
        }
        if( array_key_exists( 'filter_user_name' , $all_search ) && !empty( $all_search[ 'filter_user_name' ] ) ){
            $query->whereHas( 'user' , function( $query ) use ( $all_search ){
                $query->where( 'user_name' , $all_search[ 'filter_user_name' ] );
            } );
        }
        if( array_key_exists( 'filter_wb_id' , $all_search ) && !empty( $all_search[ 'filter_wb_id' ] ) ){
            $query->where( 'wb_id' , $all_search[ 'filter_wb_id' ] );
        }
        if( array_key_exists( 'filter_wb_type' , $all_search ) && !empty( $all_search[ 'filter_wb_type' ] ) ){
            $query->where( 'wb_type' , $all_search[ 'filter_wb_type' ] );
        }
        if( array_key_exists( 'filter_wb_mode' , $all_search ) && !empty( $all_search[ 'filter_wb_mode' ] ) ){
            $query->whereIn( 'wb_mode' , $all_search[ 'filter_wb_mode' ] );
        }
        return $query;
    }

    public function create( Request $request ){
        DB::beginTransaction();
        try{
            $validated = $request->all();
            $user      = JWTAuth::parseToken()->authenticate();
            if( !isset( $validated[ 'w_id' ] ) || empty( $validated[ 'w_id' ] ) ){
                return MyHelper::response( false , 'Không tìm thấy kho hàng' , [] , 500 );
            }
            $arr_err     = [];
            $arr_success = [];
            foreach( $validated as $key => $archive_info ){
                if( startsWith( $key , 'w_id' ) && !empty( $validated[ 'w_id' ] ) ){
                    $check_w = Warehouse::where( 'w_id' , $validated[ 'w_id' ] )->exists();
                    if( !$check_w ){
                        return MyHelper::response( false , 'Không tìm thấy kho hàng' , [] , 500 );
                    }
                }
                if( !startsWith( $key , 'archive_' ) ){
                    continue;
                }
                $exist = WarehouseProductArchive::where( 'prd_id' , $archive_info[ 'prd_id' ] )->where( 'w_id' , $validated[ 'w_id' ] )->first();
                if( $exist ){
                    $exist->wpa_min = $archive_info[ 'wpa_min' ];
                    $exist->wpa_max = $archive_info[ 'wpa_max' ];
                    $exist->save();
                    $create = true;
                }else{
                    $create = WarehouseProductArchive::create( [
                        'prd_id'     => $archive_info[ 'prd_id' ] ,
                        'w_id'       => $validated[ 'w_id' ] ,
                        'wpa_min'    => $archive_info[ 'wpa_min' ] ,
                        'wpa_max'    => $archive_info[ 'wpa_max' ] ,
                        'user_id'    => $user->user_id ,
                        'groupid'    => $user->groupid ,
                        'created_at' => time() ,
                    ] );
                }
                if( !$create ){
                    $arr_err[] = $archive_info[ 'prd_id' ];
                }else{
                    $arr_success[] = $archive_info[ 'prd_id' ];
                }
            }
            if( !empty( $arr_err ) ){
                DB::rollback();
                return MyHelper::response( false , 'Tạo mới thất bại' , $arr_err , 500 );
            }
            if( !empty( $arr_success ) ){
                DB::commit();
                return MyHelper::response( true , 'Tạo mới thành công' , [] , 200 );
            }else{
                return MyHelper::response( false , 'Không dữ liệu mới nào được thêm' , [] , 500 );
            }
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , 'Tạo mới thất bại' , [] , 500 );
        }
    }

    public function update( UpdateArchiveRequest $request ){
        DB::beginTransaction();
        try{
            $validated = $request->validated();
            $exist     = WarehouseProductArchive::where( 'prd_id' , $validated[ 'prd_id' ] )->where( 'w_id' , $validated[ 'w_id' ] )->first();
            if( $exist ){
                $exist->wpa_min = $validated[ 'wpa_min' ];
                $exist->wpa_max = $validated[ 'wpa_max' ];
                $exist->save();
                return MyHelper::response( true , 'Cập nhật thành công' , [] , 200 );
            }else{
                return MyHelper::response( false , 'Không dữ liệu mới nào được cập nhật' , [] , 500 );
            }
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , 'Cập nhật thất bại' , [] , 500 );
        }
    }
}
