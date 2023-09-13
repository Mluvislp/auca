<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\WarehouseProduct;
use Auth;
use DB;
use JWTAuth;

trait WarehouseProductTrait {
    public function createWarehouseProduct( $validated ){
        $user = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $existingRecord = WarehouseProduct::where('prd_id', $validated['prd_id'])->where('w_id', $validated['w_id'])->first();
            if ($existingRecord) {
                if($validated[ 'type' ] == 'Export'){
                    $existingRecord->wp_quantity -= $validated['wp_quantity'];
                    $existingRecord->wp_quantity_defective -= $validated['wp_quantity_defective'];
                    $existingRecord->save();
                }else{
                    $existingRecord->wp_quantity += $validated['wp_quantity'];
                    $existingRecord->wp_quantity_defective += $validated['wp_quantity_defective'];
                    $existingRecord->save();
                }
                $id = $validated['prd_id'];
            } else {
                $id = WarehouseProduct::insertGetId( [
                    'w_id'                  => $validated[ 'w_id' ] ,
                    'prd_id'                => $validated[ 'prd_id' ] ,
                    'wp_quantity'           => $validated[ 'wp_quantity' ] ,
                    'wp_quantity_defective' => $validated[ 'wp_quantity_defective' ] ,
                    'groupid'               => $user->groupid ,
                ] );
            }
            if( $id ){
                DB::commit();
                return $id;
            }else{
                DB::rollback();
                return false;
            }
        }catch( \Exception $ex ){
            dd($ex);
            DB::rollback();
            return false;
        }
    }
    public function getProductByIdAndWarehouse($id , $w_id){
        $product = WarehouseProduct::where( 'prd_id' , $id )->where( 'w_id' , $w_id )->with(['warehouse'=> function( $query ){
                $query->select( 'w_id' , 'w_name');
            }])->with('product')->first();
        if(!$product ){
            return false;
        }
        return $product;

    }
}
