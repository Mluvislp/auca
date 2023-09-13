<?php

namespace App\Traits;

use App\Models\Warranty;
use Auth;
use Illuminate\Support\Facades\DB;
use JWTAuth;

trait WarrantyTrait {
    use CountryTraits;

    public function createWarranty( $validated , $prd_id , $arr_general ){
        try{
           DB::beginTransaction();
            $country_iso = '';
            if( $validated[ 'country_id' ] && !empty( $validated[ 'country_id' ] ) ){
                $country_iso_model = $this->findFirstByCountryId( $validated[ 'country_id' ] );
                if( $country_iso_model ){
                    $country_iso = $country_iso_model->country_iso;
                }
            }
            $query = Warranty::create( [
                'prd_id'       => $prd_id ,
                'country_iso'  => $country_iso ,
                'country_id'   => $validated[ 'country_id' ] ,
                'wa_address'   => $validated[ 'wa_address' ] ,
                'wa_tel'       => $validated[ 'wa_tel' ] ,
                'wa_num_month' => $validated[ 'wa_num_month' ] ,
                'wa_content'   => $validated[ 'wa_content' ] ,
                'groupid'      => $arr_general[ 'groupid' ] ,
                'user_id'      => $arr_general[ 'user_id' ] ,
                'created_at'   => $arr_general[ 'created_at' ] ,
                'updated_at'   => $arr_general[ 'updated_at' ] ,
            ] );
            if( $query ){
                DB::commit();
                return true;
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
    public function updateWarranty( $validated ): bool{
        try{
            DB::beginTransaction();
            $model = ( new Warranty() )->findFirstByProduct( $validated[ 'prd_id' ] );
            if( !$model ){
                return true;
            }
            $country_iso = '';
            if( isset($validated[ 'country_id' ]) && !empty( $validated[ 'country_id' ] ) ){
                $country_iso_model = $this->findFirstByCountryId( $validated[ 'country_id' ] );
                if( $country_iso_model ){
                    $country_iso = $country_iso_model->country_iso;
                }
            }
            $status = $model->update( [
                'country_iso'  => $country_iso ,
                'country_id'   => $validated[ 'country_id' ] ,
                'wa_address'   => $validated[ 'wa_address' ] ,
                'wa_tel'       => $validated[ 'wa_tel' ] ,
                'wa_num_month' => $validated[ 'wa_num_month' ] ,
                'wa_content'   => $validated[ 'wa_content' ] ,
                'updated_at'   => time() ,
            ] );
            if($status){
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
