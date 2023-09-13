<?php

namespace App\Traits;

use Auth;
use DB;
use JWTAuth;

trait PackageTrait {
    use ProductTraits , ProductOfPackageTrait;

    public function exchangeDataForProductAndCreate( $validated ){
        $data = [
            'prd_name'           => $validated[ 'pack_name' ] ,
            'prd_type_id'        => 5 ,
            'prd_code'           => $validated[ 'pack_code' ] ,
            'prd_barcode'        => null ,
            'prd_status_id'      => 1 ,
            'cat_id'             => $validated[ 'cat_id' ] ,
            'cat_inter_id'       => null ,
            'brand_id'           => null ,
            'sup_id'             => null ,
            'pd_first_remain'    => $validated[ 'pack_quantity' ] ,
            'w_id'               => $validated[ 'w_id' ] ,
            'pd_import_price'    => $validated[ 'total_money' ] ,
            'pd_image'           => null ,
            'pd_vat'             => null ,
            'pd_price'           => null ,
            'pd_wholesale_price' => null ,
            'pd_old_price'       => null ,
            'pd_shipping_weight' => null ,
            'pd_unit'            => null ,
            'pd_lenght'          => null ,
            'pd_height'          => null ,
            'pd_width'           => null ,
            'country_id'         => null ,
            'wa_address'         => null ,
            'wa_tel'             => null ,
            'wa_num_month'       => null ,
            'wa_content'         => null ,
        ];
        $res  = $this->createProduct( $data , false );
        if( $res[ 'status' ] ){
            foreach( $validated[ 'product' ] as $product ){
                $prd_pack_data = [
                    'prd_id'       => $product[ 'prd_id' ] ,
                    'prd_id_pack'  => $res[ 'prd_id' ] ,
                    'pop_quantity' => $product[ 'p_quantity' ] ,
                ];
                $this->createProductOfPackage( $prd_pack_data );
            }
            return true;
        }
        return false;
    }

    public function exchangeDataForBillExportAndCreate( $validated , $type = 'Export' ){
        $arr_product = [];
        foreach( $validated[ 'product' ] as $product ){
            $arr_product[] = [
                "prd_id"                 => $product[ 'prd_id' ] ,
                "wbp_quantity"           => $product[ 'p_quantity' ] ,
                "wbp_quantity_defective" => 0 ,
                "wbp_price"              => $product[ 'p_price' ] ,
                "wbp_discount_type"      => "Money" ,
                "wbp_discount_value"     => 0 ,
                "wbp_shipping_weight"    => null ,
                "wbp_note"               => ""
            ];
        }
        $data = [
            'w_id'                    => $validated[ 'w_id' ] ,
            'wb_type'                 => $type ,
            'wb_mode'                 => 2 ,
            'sup_id'                  => null ,
            'wb_customer_name'        => null ,
            'wb_customer_tel'         => null ,
            'wb_description'          => $validated[ 'pack_note' ] ,
            'wb_vat_type'             => 'Money' ,
            'wb_vat_value'            => null ,
            'wb_tax_bill_code'        => null ,
            'wb_tax_bill_date'        => null ,
            'wb_manual_discount_type' => 'Money' ,
            'wb_manual_discount'      => null ,
            'wb_total_money'          => $validated[ 'total_money' ] ,
            'wb_money'                => null ,
            'ca_id'                   => null ,
            'wb_money_transfer'       => null ,
            'ta_id'                   => null ,
            'wb_debt_due_date'        => null ,
            'product'                 => $arr_product
        ];
        return $this->createWareHouseBill( $data , false );
    }
        //extract
    public function createExportForPack( $pack_extract , $pack_info , $type = 'Export' ){
        $import_price_of_pack = $pack_info[ 'product_detail' ][ 'pd_import_price' ] ?? 0;
        $arr_product[] = [
            "prd_id"                 => $pack_info[ 'prd_id' ] ,
            "wbp_quantity"           => $pack_extract[ 'pack_quantity' ] ?? 0 ,
            "wbp_quantity_defective" => 0 ,
            "wbp_price"              => $import_price_of_pack,
            "wbp_discount_type"      => "Money" ,
            "wbp_discount_value"     => 0 ,
            "wbp_shipping_weight"    => null ,
            "wbp_note"               => ""
        ];
        $data          = [
            'w_id'                    => $pack_info[ 'w_id' ] ,
            'wb_type'                 => $type ,
            'wb_mode'                 => 2 ,
            'sup_id'                  => null ,
            'wb_customer_name'        => null ,
            'wb_customer_tel'         => null ,
            'wb_description'          => null ,
            'wb_vat_type'             => 'Money' ,
            'wb_vat_value'            => null ,
            'wb_tax_bill_code'        => null ,
            'wb_tax_bill_date'        => null ,
            'wb_manual_discount_type' => 'Money' ,
            'wb_manual_discount'      => null ,
            'wb_total_money'          => $import_price_of_pack * $pack_extract['pack_quantity'] ,
            'wb_money'                => null ,
            'ca_id'                   => null ,
            'wb_money_transfer'       => null ,
            'ta_id'                   => null ,
            'wb_debt_due_date'        => null ,
            'product'                 => $arr_product
        ];
        return $this->createWareHouseBill( $data , false );
    }
    public function exchangeDataForBillImportAndCreate( $pack_extract , $pack_info  , $type = 'Import' ){
        $arr_product = [];
        $total_money = 0;
        if(!empty($pack_info[ 'product_of_pack' ])){
            foreach( $pack_info[ 'product_of_pack' ] as $product ){
                $quantity_import = $pack_extract[ 'pack_quantity' ] * $product['pop_quantity'];
                $import_price = $product[ 'product_detail_of_product_pack' ][ 'product_detail' ][ 'pd_import_price' ] ?? 0;
                $total_price_import = $import_price*$quantity_import;
                $total_money+=$total_price_import;
                $arr_product[] = [
                    "prd_id"                 => $product[ 'prd_id' ] ,
                    "wbp_quantity"           => $quantity_import,
                    "wbp_quantity_defective" => 0 ,
                    "wbp_price"              => $import_price,
                    "wbp_discount_type"      => "Money" ,
                    "wbp_discount_value"     => 0 ,
                    "wbp_shipping_weight"    => null ,
                    "wbp_note"               => null
                ];
            }
        }else{
            return true;
        }
        $data = [
            'w_id'                    => $pack_info[ 'w_id' ] ,
            'wb_type'                 => $type ,
            'wb_mode'                 => 2 ,
            'sup_id'                  => null ,
            'wb_customer_name'        => null ,
            'wb_customer_tel'         => null ,
            'wb_description'          => null ,
            'wb_vat_type'             => 'Money' ,
            'wb_vat_value'            => null ,
            'wb_tax_bill_code'        => null ,
            'wb_tax_bill_date'        => null ,
            'wb_manual_discount_type' => 'Money' ,
            'wb_manual_discount'      => null ,
            'wb_total_money'          => $total_money ,
            'wb_money'                => null ,
            'ca_id'                   => null ,
            'wb_money_transfer'       => null ,
            'ta_id'                   => null ,
            'wb_debt_due_date'        => null ,
            'product'                 => $arr_product
        ];
        return $this->createWareHouseBill( $data , false );
    }

}
