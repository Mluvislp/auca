<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\Country;
use Auth;

trait CountryTraits {
    public function ListAll( $req ){
        try{
            $all_search = $req->all();
            $query = Country::query();
            if( array_key_exists( 'filter_country_name' , $all_search ) && !empty( $all_search[ 'filter_country_name' ] ) ){
                $query->where( 'country_nicename' ,"LIKE", "%".$all_search[ 'filter_country_name' ]."%" );
            }
            $list = $query->get();
            return MyHelper::response( true , 'Successfully' , $list , 200 );
        }catch( \Exception $e ){
            return MyHelper::response( false , 'Không thể lấy dữ liệu về quốc gia' , [] , 404 );
        }
    }
    public function findFirstByCountryId($id){
        return (new Country())->findFirstById($id);
    }

}
