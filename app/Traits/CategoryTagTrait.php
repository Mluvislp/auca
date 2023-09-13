<?php

namespace App\Traits;

use App\Models\CategoryTag;
use Auth;
use DB;
use JWTAuth;

trait CategoryTagTrait {
    public function createCategoryTag ($arr, $id) {
        foreach($arr as $value){
            $input = [
                'ctag_id' => $value, 'cat_id' => $id,
            ];
            ( new CategoryTag() )->createnew($input);
        }
    }
    public function getAllByCategory($id){
        return ( new CategoryTag() )->getByCatId($id);
    }
    public function deleteByCatId($id){
        return ( new CategoryTag() )->deleteByCatId($id);
    }

}
