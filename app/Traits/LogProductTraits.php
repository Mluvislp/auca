<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\LogProduct;
use App\Models\Product;
use App\Models\RealationProductVariantValue;
use Auth;
use Illuminate\Support\Facades\DB;
use JWTAuth;

trait LogProductTraits {
    use ProductDetailTraits , WarrantyTrait;

    public function getAllLog( $req ){
        try{
            $perPage    = $req->input( 'per_page' , 10 );
            $all_search = $req->all();
            if( !array_key_exists( 'log_type' , $all_search ) && empty( $all_search[ 'log_type' ] ) ){
                return MyHelper::response( false , 'Không thể lấy dữ liệu' , [] , 404 );
            }else{
                $all_search[ 'log_type' ] = (int)$all_search[ 'log_type' ];
                if( $all_search[ 'log_type' ] !== LogProduct::EDIT_PRICE &&
                    $all_search[ 'log_type' ] !== LogProduct::EDIT_IMPORT_PRICE &&
                    $all_search[ 'log_type' ] !== LogProduct::HISTORY
                ){
                    return MyHelper::response( false , 'Kiểu log không hợp lệ' , [] , 400 );
                }
            }
            $query    = LogProduct::query();
            $log_type = '';
            switch( (int)$all_search[ 'log_type' ] ){
                case LogProduct::EDIT_IMPORT_PRICE :
                    $log_type = [ LogProduct::EDIT_IMPORT_PRICE ];
                    break;
                case LogProduct::EDIT_PRICE :
                    $log_type = [ LogProduct::EDIT_PRICE ];
                    break;
                case LogProduct::HISTORY :
                    $log_type = [
                        LogProduct::HISTORY ,

                        LogProduct::EDIT_PRICE ,
                        LogProduct::EDIT_IMPORT_PRICE ,
                        LogProduct::CHANGE_EDIT_DEFECTIVE_PRODUCT ,
                        LogProduct::EDIT_COMBO ,
                        LogProduct::EDIT_UNIT ,
                        LogProduct::DELETE_PRODUCT ,
                    ];
                    break;
            }
            if( empty( $log_type ) ){
                return MyHelper::response( false , 'Không thể lấy dữ liệu' , [] , 404 );
            }
            $query = $this->handleFilter( $query , $all_search , $log_type );
            $list  = $query->paginate( $perPage );
            $data  = [
                'data'         => collect( $list->items() )->map( function( $list ){
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

    public function handleFilter( $query , $all_search , $log_type ){
        foreach( $log_type as $key => $type ){
            if( $key > 0 ){
                $query->orWhereJsonContains( 'log_prd_type->type_id' , $type );
            }else if( $key == 0 ){
                $query->whereJsonContains( 'log_prd_type->type_id' , $type );
            }
        }
        if( array_key_exists( 'filter_log_step' , $all_search ) && !empty( $all_search[ 'filter_log_step' ] ) ){
            $query->whereJsonContains( 'log_prd_step->step_id' ,  $all_search[ 'filter_log_step' ] );
        }
        if( array_key_exists( 'filter_log_type' , $all_search ) && !empty( $all_search[ 'filter_log_type' ] ) ){
            $query->whereJsonContains( 'log_prd_type->type_id' ,  $all_search[ 'filter_log_type' ] );
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
        if( array_key_exists( 'filter_child_parent' , $all_search ) && !empty( $all_search[ 'filter_child_parent' ] ) ){
            $query->whereHas( 'product' , function( $query ) use ( $all_search ){
                switch( $all_search[ 'filter_child_parent' ] ){
                    case 1:
                        //cha
                        $query->has( 'children' );
                        break;
                    case 2:
                        //doc lap
                        $query->whereDoesntHave( 'children' )->whereDoesntHave( 'parent' );
                        break;
                    case 3:
                        //con
                        $query->has( 'parent' );
                        break;
                    case 4:
                        //cha + doc lap
                        $query->where( function( $query ){
                            $query->whereHas( 'children' )->orWhereNull( 'prd_parent_id' );
                        } );
                        break;
                    case 5:
                        //con + doc lap
                        $query->where( function( $query ){
                            $query->whereHas( 'parent' )->orWhereNull( 'prd_parent_id' );
                        } );
                        break;
                    default :
                        break;
                }
            } );
        }
        if( array_key_exists( 'filter_user_id' , $all_search ) && !empty( $all_search[ 'filter_user_id' ] ) ){
            $query->whereHas( 'user' , function( $query ) use ( $all_search ){
                $query->where( 'user_name' ,"LIKE", "%".$all_search[ 'filter_user_id' ]."%" );
            } );
        }
        return $query;
    }

    public function addLog( $data , $old_product , $product ){
        try{
            $user = JWTAuth::parseToken()->authenticate();
            DB::beginTransaction();
            $data   = $this->extractData( $data , $old_product , $product );
            $create = LogProduct::create( [
                'w_id'              => $validated[ 'w_id' ] ?? null ,
                'prd_id'            => $data[ 'prd_id' ] ,
                'log_prd_name'      => $data[ 'log_prd_name' ] ,
                'log_prd_code'      => $data[ 'log_prd_code' ] ,
                'log_prd_type'      => json_encode( $data[ 'log_prd_type' ] ) ,
                'log_prd_step'      => json_encode( $data[ 'log_prd_step' ] ) ,
                'log_prd_old_value' => json_encode( $data[ 'log_prd_old_value' ] ) ,
                'log_prd_new_value' => json_encode( $data[ 'log_prd_new_value' ] ) ,
                'groupid'           => $user->groupid ,
                'user_id'           => $user->user_id ,
                'created_at'        => time() ,
            ] );
            if( !$create ){
                DB::rollback();
                return false;
            }
            DB::commit();
            return true;
        }catch( \Exception $ex ){
            DB::rollback();
            return false;
        }
    }

    public function extractData( $data = [] , $old_value , $product ){
        try{
            $out_put           = [
                'prd_id'       => $product[ 'prd_id' ] ,
                'log_prd_name' => $product[ 'prd_name' ] ,
                'log_prd_code' => $product[ 'prd_code' ] ,
            ];
            $log_prd_old_value = [];
            $log_prd_new_value = [];
            $log_prd_type      = [
                'type_id' => []
            ];
            $log_prd_step      = [
                'step_id' => []
            ];
            if( array_key_exists( 'pd_price' , $data ) && $data[ 'pd_price' ] != $old_value[ 'pd_price' ] ){
                $log_prd_type[ 'type_id' ][]     = LogProduct::EDIT_PRICE;
                $log_prd_step[ 'step_id' ][]     = LogProduct::STEP_EDIT_PRODUCT;
                $log_prd_old_value[ 'pd_price' ] = $old_value[ 'pd_price' ];
                $log_prd_new_value[ 'pd_price' ] = $data[ 'pd_price' ];
            }
            if( array_key_exists( 'pd_import_price' , $data ) && $data[ 'pd_import_price' ] != $old_value[ 'pd_import_price' ] ){
                $log_prd_type[ 'type_id' ][]            = LogProduct::EDIT_IMPORT_PRICE;
                $log_prd_step[ 'step_id' ][]            = LogProduct::STEP_EDIT_PRODUCT;
                $log_prd_old_value[ 'pd_import_price' ] = $old_value[ 'pd_import_price' ];
                $log_prd_new_value[ 'pd_import_price' ] = $data[ 'pd_import_price' ];
            }
            if( array_key_exists( 'wp_quantity_defective' , $data ) && $data[ 'wp_quantity_defective' ] != $old_value[ 'wp_quantity_defective' ] ){
                $log_prd_type[ 'type_id' ][]                  = LogProduct::CHANGE_EDIT_DEFECTIVE_PRODUCT;
                $log_prd_step[ 'step_id' ][]                  = LogProduct::STEP_EDIT_DEFECTIVE_PRODUCT;
                $log_prd_old_value[ 'wp_quantity_defective' ] = $old_value[ 'wp_quantity_defective' ];
                $log_prd_new_value[ 'wp_quantity_defective' ] = $data[ 'wp_quantity_defective' ];
            }
            if( empty( $data ) ){
                $log_prd_type[ 'type_id' ][] = LogProduct::HISTORY;
                $log_prd_type[ 'type_id' ][] = LogProduct::DELETE_PRODUCT;
                $log_prd_step[ 'step_id' ][] = LogProduct::STEP_DELETE_PRODUCT;
                $selected                    = [
                    "prd_id" ,
                    "prd_name" ,
                    "prd_bar_code" ,
                    "prd_status_id" ,
                    "cat_id"
                ];
                $log_prd_old_value           = array_intersect_key( $old_value , array_flip( $selected ) );
            }
            return array_merge( $out_put , [ 'log_prd_type' => $log_prd_type ] , [ 'log_prd_step' => $log_prd_step ] , [ 'log_prd_old_value' => $log_prd_old_value ] , [ 'log_prd_new_value' => $log_prd_new_value ] );
        }catch( \Exception $ex ){
            dd( $ex );
        }
    }

}
