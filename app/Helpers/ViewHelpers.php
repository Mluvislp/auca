<?php

if (!function_exists('printVariant')) {
    function printVariant($variant, $indent = 0 , $selected = 0) {
        foreach ($variant as $val) {
            $choose = '';
            if($selected > 0 && $selected == $val->var_id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->var_id."'>".str_repeat('-', $indent) . ' ' . $val->var_name ."</option>");
            if ($val->recursiveChildren->count()) {
                printVariant($val->recursiveChildren, $indent + 1 ,$selected);
            }
        }
    }
}
if (!function_exists('printCategoriesMultipleChoise')) {
    function printCategoriesMultipleChoise($categories, $indent = 0 , $selected = []) {
        $selected = removeNullValueFromArray($selected);
        foreach ($categories as $val) {
            $choose = '';
            if(in_array($val->cat_id, $selected)){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->cat_id."'>".str_repeat('-', $indent) . ' ' . $val->cat_name ."</option>");
            if ($val->recursiveChildren->count()) {
                printCategoriesMultipleChoise($val->recursiveChildren, $indent + 1 ,$selected);
            }
        }
    }
}
if (!function_exists('printCatTagMultipleChoise')) {
    function printCatTagMultipleChoise($cat_tag,  $selected = [] ) {
        $selected = removeNullValueFromArray($selected);
        foreach ($cat_tag as $val) {
            $choose = '';
            if(in_array($val->ctag_id, $selected)){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->ctag_id."'>". $val->ctag_name ."</option>");
        }
    }
}
if (!function_exists('printProductType')) {
    function printProductType($product_type,  $selected = '' ) {
        echo("<option></option>");
        foreach ($product_type as $val) {
            $choose = '';
            if($val->prd_type_id == $selected){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->prd_type_id."'>". $val->prd_type_name ."</option>");
        }
    }
}
if (!function_exists('printProductStatus')) {
    function printProductStatus($product_status,  $selected = 1 ,$edit = false) {
        echo("<option>--</option>");
        foreach ($product_status as $val) {
            $choose = '';
            if(!$edit){
                if($val->prd_status_id == $selected){
                    $choose = 'selected';
                }
            }
            echo("<option ".$choose." value='".$val->prd_status_id."'>". $val->prd_status_name ."</option>");
        }
    }
}
if (!function_exists('printProductStatusForFilter')) {
    function printProductStatusForFilter($product_status,  $selected = '' ) {
        foreach ($product_status as $val) {
            $choose = '';
            if($val->prd_status_id == $selected){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->prd_status_id."'>". $val->prd_status_name ."</option>");
        }
    }
}
if (!function_exists('printCategories')) {
    function printCategories($categories, $selected = '' , $indent = 0) {
        foreach ($categories as $val) {
            $choose = '';
            if($selected > 0 && $selected == $val->cat_id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->cat_id."'>".str_repeat('-', intval($indent)) . ' ' . $val->cat_name ."</option>");
            if ($val->recursiveChildren->count()) {
                printCategories($val->recursiveChildren, $selected , $indent + 1 );
            }
        }
    }
}
if (!function_exists('printWarehosue')) {
    function printWarehosue($warehouse, $selected = '') {
        foreach ($warehouse as $val) {
            $choose = '';
            if($selected > 0 && $selected == $val->w_id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->w_id."'>". $val->w_name ."</option>");
        }
    }
}
if (!function_exists('printBrand')) {
    function printBrand($brand, $selected = '') {
        foreach ($brand as $val) {
            $choose = '';
            if($selected > 0 && $selected == $val->brand_id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->brand_id."'>". $val->brand_name ."</option>");
        }
    }
}
if (!function_exists('printVariantGroupMultipleChoise')) {
    function printVariantGroupMultipleChoise($variant_group, $selected = []) {
        $selected = removeNullValueFromArray($selected);
        foreach ($variant_group as $val) {
            $choose = '';
            if(in_array($val->cat_id, $selected)){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->vg_id."'>". $val->vg_name ."</option>");
        }
    }
}
if (!function_exists('printVariantValue')) {
    function printVariantValue($variant_val, $indent = 0 , $selected = 0) {
        foreach ($variant_val as $val) {
            $choose = '';
            if($selected > 0 && $selected == $val->vv_id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->vv_id."'>".str_repeat('-', $indent) . ' ' . $val->vv_name ."</option>");
            if ($val->recursiveChildren->count()) {
                printVariantValue($val->recursiveChildren, $indent + 1 ,$selected);
            }
        }
    }
}
if (!function_exists('removeNullValueFromArray')) {
    function removeNullValueFromArray($arr) {
        if(empty($arr) || is_null($arr)){
            return [];
        }
        $new_arr = array_filter( $arr , function( $value ){
            return !is_null( $value );
        } );
        return $new_arr;
    }
}
if (!function_exists('renderTypeValue')) {
    function renderTypeValue($input = "") {
        $arr_val = [
         "Select", "Text" , "Checkbox" ,"Number"
        ];
        foreach($arr_val as $val){
            $choose = $input == $val ? "selected" : '';
            echo("<option ".$choose." value='".$val."'>".$val."</option>");
        }
    }
}
if (!function_exists('getOptionSupplierType')) {
    function getOptionSupplierType($id) {
       $sup_type = \App\Models\SupplierType::all();
        foreach($sup_type as $val){
            $choose = ($id == $val->sup_type_id ? "selected" : '');
            echo("<option ".$choose." value='".$val->sup_type_id."'>".$val->sup_type_name."</option>");
        }
    }
}
if (!function_exists('getNameSupplierType')) {
    function getNameSupplierType($id) {
        $sup_type = \App\Models\SupplierType::all();
        foreach($sup_type as $val){
           if($id == $val->sup_type_id){
               return $val->sup_type_name;
           }
        }
    }
}
if (!function_exists('printTypeSuplier')) {
    function printTypeSuplier($selected_id = 0) {
        $supliertype = \App\Models\SupplierType::all();
        foreach ($supliertype as $val) {
            $choose = '';
            if($selected_id > 0 && $selected_id == $val->sup_type_id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->sup_type_id."'>". $val->sup_type_name ."</option>");
        }
    }
}
if (!function_exists('printGroup')) {
    function printGroup($group , $selected_id = 0) {
        foreach ($group as $val) {
            $choose = '';
            if($selected_id > 0 && $selected_id == $val->id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->id."'>". $val->group_name ."</option>");
        }
    }
}
if (!function_exists('printWarehouse')) {
    function printWarehouse($w , $selected_id = 0) {
        foreach ($w as $val) {
            $choose = '';
            if($selected_id > 0 && $selected_id == $val->w_id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->w_id."'>". $val->w_name ."</option>");
        }
    }
}
if (!function_exists('printCategoryInternal')) {
    function printCategoryInternal($cat, $indent = 0 , $selected = 0) {
        foreach ($cat as $val) {
            $choose = '';
            if($selected > 0 && $selected == $val->cat_inter_id){
                $choose = 'selected';
            }
            echo("<option ".$choose." value='".$val->cat_inter_id."'>".str_repeat('-', $indent) . ' ' . $val->cat_inter_name ."</option>");
            if ($val->recursiveChildren->count()) {
                printCategoryInternal($val->recursiveChildren, $indent + 1 , $selected);
            }
        }
    }
}

