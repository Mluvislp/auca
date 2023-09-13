<?php

namespace App\Traits;


use App\Models\ProductType;

trait ProductTypeTraits {

    public function getProductTypeForCombobox(){
        $brand = (new ProductType())->getIdAndNameForCombo();
        if($brand){
            return $brand;
        }
        return [];
    }
}
