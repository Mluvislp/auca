<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\LogProduct;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductStatus;
use App\Models\ProductType;
use App\Models\RelationProductVariantValue;
use App\Models\Warehouse;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Milon\Barcode\DNS1D;

trait ProductInventoryTraits {
    use ProductDetailTraits , WarrantyTrait , WarehouseBillTrait , LogProductTraits;

    public function ListAll( $req ){
        try{
            $perPage    = $req->input( 'per_page' , 10 );
            $all_search = $req->all();
            $query      = Product::query();
            $query      = $this->handleFilter( $query , $all_search );
            $list       = $query->select( 'prd_id' , 'prd_name' , 'prd_type_id' , 'prd_parent_id' , 'prd_code' , 'prd_barcode' )->with( [
                'warehouse' => function( $query ){
                    $query->select( 'warehouse.w_name' , 'warehouse.w_country_iso' , 'warehouse.groupid' , 'warehouse_product.w_id' , 'warehouse_product.wp_quantity' , 'warehouse_product.wp_quantity_defective' )->orderBy( 'w_id' );
                }
            ] )->paginate( $perPage );
            $list_w     = Warehouse::select( 'w_id' , 'w_name' , 'w_country_iso' )->orderBy( 'w_id' )->get();
            $arr_w_id  = $list_w->pluck( 'w_id' );
            $diff      = [];
            if( array_key_exists( 'filter_w_id' , $all_search ) && !empty( $all_search[ 'filter_w_id' ] ) ){
                $warehouse_arr = $all_search[ 'filter_w_id' ] ;
                $diff1     = array_diff( $warehouse_arr , $arr_w_id->toArray() );
                $diff2     = array_diff( $arr_w_id->toArray() , $warehouse_arr );
                $diff      = array_merge( $diff1 , $diff2 );
            }
            $data = [
                'data'         => collect( $list->items() )->map( function( $list ) use ( $list_w , $diff ){
                    if( empty( $list->warehouse->toArray() ) ){
                        foreach( $list_w as $w_l ){
                            $list->warehouse[ $w_l[ 'w_id' ] ] = array_merge( $w_l->toArray() , [
                                "w_id"                  => $w_l[ 'w_id' ] ,
                                "w_name"                => $w_l[ 'w_name' ] ,
                                "w_country_iso"         => $w_l[ 'w_country_iso' ] ,
                                "wp_quantity"           => 0 ,
                                "wp_quantity_defective" => 0 ,
                            ] );
                        }
                    }else{
                        $new_w = [];
                        foreach( $list_w as $item ){
                            $wId    = $item[ 'w_id' ];
                            $exists = false;
                            foreach( $list->warehouse as $warehouse ){
                                if( $warehouse[ 'w_id' ] === $wId ){
                                    $new_w[ $warehouse[ 'w_id' ] ] = $warehouse;
                                    $exists                        = true;
                                    break;
                                }
                            }
                            if( !$exists ){
                                $new_w[ $item[ 'w_id' ] ] = [
                                    "w_id"                  => $item[ 'w_id' ] ,
                                    "w_name"                => $item[ 'w_name' ] ,
                                    "w_country_iso"         => "" ,
                                    "wp_quantity"           => 0 ,
                                    "wp_quantity_defective" => 0 ,
                                ];
                            }
                        }
                        unset( $list->warehouse );
                        $list->warehouse = $new_w;
                    }
                    $total = 0;
                    foreach( $list->warehouse as $w ){
                        if (!in_array($w['w_id'], $diff)) {
                            $total += $w['wp_quantity'];
                        }
                    }
                    $list->total = $total;
                    unset( $list->warehouse_product );
                    return $list;
                } ) ,
                'total'        => $list->total() ,
                'per_page'     => $list->perPage() ,
                'current_page' => $list->currentPage() ,
            ];
            return MyHelper::response( true , 'Successfully' , $data , 200 );
        }catch( \Exception $e ){
            dd( $e );
            return MyHelper::response( false , 'Không thể lấy dữ liệu' , [] , 404 );
        }
    }

    public function handleFilter( $query , $all_search ){
        if( array_key_exists( 'filter_prd_id' , $all_search ) && !empty( $all_search[ 'filter_prd_id' ] ) ){
            $query->where( 'prd_id' , $all_search[ 'filter_prd_id' ] );
        }
        if( array_key_exists( 'filter_prd_id_box' , $all_search ) && !empty( $all_search[ 'filter_prd_id_box' ] ) ){
            $query->where( 'prd_id' , $all_search[ 'filter_prd_id_box' ] );
        }
//        if( array_key_exists( 'filter_w_id' , $all_search ) && !empty( $all_search[ 'filter_w_id' ] ) ){
//            $query->whereHas( 'warehouseProduct' , function( $q ) use ( $all_search ){
//                $q->whereIn( 'w_id' , $all_search[ 'filter_w_id' ] );
//            } );
//        }
        if( array_key_exists( 'filter_brand_id' , $all_search ) && !empty( $all_search[ 'filter_brand_id' ] ) ){
            $query->whereIn( 'brand_id' , $all_search[ 'filter_brand_id' ] );
        }
        if( array_key_exists( 'filter_prd_type_id' , $all_search ) && !empty( $all_search[ 'filter_prd_type_id' ] ) ){
            $query->where( 'prd_type_id' , $all_search[ 'filter_prd_type_id' ] );
        }
        if( array_key_exists( 'filter_prd_cat_id' , $all_search ) && !empty( $all_search[ 'filter_prd_cat_id' ] ) ){
            $query->whereIn( 'cat_id' , $all_search[ 'filter_prd_cat_id' ] );
        }
        if( array_key_exists( 'filter_prd_status_id' , $all_search ) && !empty( $all_search[ 'filter_prd_status_id' ] ) ){
            $query->where( 'prd_status_id' , $all_search[ 'filter_prd_status_id' ] );
        }
        if( array_key_exists( 'filter_prd_cat_inter_id' , $all_search ) && !empty( $all_search[ 'filter_prd_cat_inter_id' ] ) ){
            $query->whereIn( 'cat_inter_id' , $all_search[ 'filter_prd_cat_inter_id' ] );
        }
        if( array_key_exists( 'filter_prd_sup_id' , $all_search ) && !empty( $all_search[ 'filter_prd_sup_id' ] ) ){
            $query->where( 'sup_id' , $all_search[ 'filter_prd_sup_id' ] );
        }
        return $query;
    }

    public function getHead( $request ){
        $request = $request->all();
        $list_w  = Warehouse::select( 'w_id' , 'w_name' , 'w_country_iso' )->orderBy( 'w_id' )->get();
        if( !$list_w ){
            goto endhead;
        }
        $arr_w_id  = $list_w->pluck( 'w_id' );
        $intersect = $arr_w_id;
        $diff      = [];
        if( array_key_exists( 'filter_w_id' , $request ) && !empty( $request[ 'filter_w_id' ] ) ){
            $warehouse_arr = json_decode( $request[ 'filter_w_id' ] );
            if( !empty( $warehouse_arr ) ){
                $diff1     = array_diff( $warehouse_arr , $arr_w_id->toArray() );
                $diff2     = array_diff( $arr_w_id->toArray() , $warehouse_arr );
                $intersect = array_intersect( $arr_w_id->toArray() , $warehouse_arr );
                $diff      = array_merge( $diff1 , $diff2 );
            }
        }
        $arr_name = [];
        foreach( $list_w as $w ){
            $arr_name[ $w->w_id ] = $w->w_name;
        }
        $res = [
            'count'     => $list_w->count() ,
            'name'      => $arr_name ,
            'diff'      => $diff ,
            'intersect' => $intersect ,
            'all'       => $arr_w_id ,
        ];
        return MyHelper::response( true , 'Successfully' , $res , 200 );

        endhead:
        return MyHelper::response( false , 'Không lấy được kho' , [] , 200 );

    }
}
