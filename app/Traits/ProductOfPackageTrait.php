<?php

namespace App\Traits;

use App\Models\ProductOfPackage;
use DB;

trait ProductOfPackageTrait {
    public function createProductOfPackage( $validated ){
        try{
            DB::beginTransaction();
            $id = ProductOfPackage::insertGetId( [
                'prd_id'       => $validated[ 'prd_id' ] ,
                'prd_id_pack'  => $validated[ 'prd_id_pack' ] ,
                'pop_quantity' => $validated[ 'pop_quantity' ] ,
            ] );
            if( $id ){
                DB::commit();
                return true;
            }else{
                DB::rollback();
                return false;
            }
        }catch( \Exception $ex ){
            DB::rollback();
            return false;
        }
    }
}
