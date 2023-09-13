<?php

namespace App\Traits;

use App\Models\CatTag;
use Auth;
use DB;
use JWTAuth;

trait CatTagTrait {
    public function getListCatTag(){
        $model = ( new CatTag() )->getAll();
        if( !$model ){
            return false;
        }
        return $model;
    }
    public function getListCatTagSelectedByCat($cat_id){
        $model = ( new CatTag() )->getAll();
        if( !$model ){
            return false;
        }
        return $model;
    }
}
