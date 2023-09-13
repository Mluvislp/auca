<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\WareHouseBillProduct;
use Auth;
use DB;
use JWTAuth;

trait WarehouseBillProductTrait {
    use WarehouseProductTrait;

    public function createWareHouseBillProduct( $validated ,$wb_id, $is_request = true ){
        $user = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $id = WareHouseBillProduct::insertGetId( [
                'wb_id'                  => $wb_id ,
                'prd_id'                 => $validated[ 'prd_id' ] ,
                'wbp_quantity'           => $validated[ 'wbp_quantity' ] ,
                'wbp_quantity_defective' => $validated[ 'wbp_quantity_defective' ] ,
                'wbp_price'              => $validated[ 'wbp_price' ] ,
                'wbp_discount_type'      => $validated[ 'wbp_discount_type' ] ,
                'wbp_discount_value'     => $validated[ 'wbp_discount_value' ] ,
                'wbp_discount_money'     => isset($validated[ 'wbp_discount_money' ]) ? $validated[ 'wbp_discount_money' ] : 0 ,
                'wbp_shipping_weight'    => $validated[ 'wbp_shipping_weight' ] ,
                'wbp_note'               => $validated[ 'wbp_note' ] ,
                'groupid'                => $user->groupid ,
            ] );
            if( $is_request ){
                if( $id ){
                    DB::commit();
                    return MyHelper::response( true , 'Tạo mới thành công id : '.$id , [] , 200 );
                }else{
                    return MyHelper::response( false , 'Tạo mới thành công id : '.$id , [] , 200 );
                }
            }else{
                if( $id ){
                    DB::commit();
                    return $id;
                }else{
                    return false;
                }
            }
        }catch( \Exception $ex ){
            dd($ex);
            DB::rollback();
            if( $is_request ){
                return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
            }
            return false;
        }
    }
}
