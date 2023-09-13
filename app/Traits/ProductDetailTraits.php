<?php

namespace App\Traits;

use App\Models\ProductDetail;
use Auth;
use Illuminate\Support\Facades\DB;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

trait ProductDetailTraits {
    public function createProductDetail( $validated , $new_id , $arr_general ){
        try{
            DB::beginTransaction();
            $pd_image           = $validated[ 'pd_image' ] ?? '';
            $name_file_pd_image = '';
            if( !is_null( $pd_image ) && !empty( $pd_image ) ){
                $upload = checkIsImageAndUpLoad( $pd_image );
                if( !$upload ){
                    $name_file_pd_image = '';
                }else{
                    $name_file_pd_image = $upload;
                }
            }
           $create =  ProductDetail::create( [
                'prd_id'             => $new_id ,
                'pd_import_price'    => $validated[ 'pd_import_price' ] ,
                'pd_vat'             => $validated[ 'pd_vat' ] ,
                'pd_price'           => $validated[ 'pd_price' ] ,
                'pd_wholesale_price' => $validated[ 'pd_wholesale_price' ] ,
                'pd_old_price'       => $validated[ 'pd_old_price' ] ,
                'pd_shipping_weight' => $validated[ 'pd_shipping_weight' ] ,
                'pd_unit'            => $validated[ 'pd_unit' ] ,
                'pd_lenght'          => $validated[ 'pd_lenght' ] ,
                'pd_width'           => $validated[ 'pd_width' ] ,
                'pd_height'          => $validated[ 'pd_height' ] ,
                'pd_image'           => $name_file_pd_image ,
                'groupid'            => $arr_general[ 'groupid' ] ,
            ] );
            if($create){
                DB::commit();
                return true;
            }else{
                DB::rollBack();
                return false;
            }
        }catch( \Exception $ex ){
            dd($ex);
            DB::rollBack();
            return false;
        }
    }

    public function createProductDetailForChild( $validated , $new_id , $extend , $arr_general ){
        try{
            DB::beginTransaction();
            if( $validated[ 'copy_parent_image' ] == 1 ){
                $pd_image = $validated[ 'pd_image' ] ?? '';
            }else{
                $pd_image = $extend['extend_image'];
            }
            $name_file_pd_image = '';
            if( !is_null( $pd_image ) && !empty( $pd_image ) ){
                $upload = checkIsImageAndUpLoad( $pd_image );
                if( !$upload ){
                    $name_file_pd_image = '';
                }else{
                    $name_file_pd_image = $upload;
                }
            }
            if( empty( $extend['extend_price_import'] ) || $extend['extend_price_import'] == 0 || is_null( $extend['extend_price_import'] ) ){
                $price_import = $validated[ 'pd_import_price' ];
            }else{
                $price_import = $extend['extend_price_import'];
            }
            if( empty( $extend['extend_price'] ) || $extend['extend_price'] == 0 || is_null( $extend['extend_price'] ) ){
                $price = $validated[ 'pd_price' ];
            }else{
                $price = $extend['extend_price'];
            }
            if( empty( $extend['extend_shipping_weight'] ) || $extend['extend_shipping_weight'] == 0 || is_null( $extend['extend_shipping_weight'] ) ){
                $shipping_weight = $validated[ 'pd_shipping_weight' ];
            }else{
                $shipping_weight = $extend['extend_shipping_weight'];
            }
            if( empty( $extend['extend_length'] ) || $extend['extend_length'] == 0 || is_null( $extend['extend_length'] ) ){
                $lenght = $validated[ 'pd_lenght' ];
            }else{
                $lenght = $extend['extend_length'];
            }
            if( empty( $extend['extend_width'] ) || $extend['extend_width'] == 0 || is_null( $extend['extend_width'] ) ){
                $width = $validated[ 'pd_width' ];
            }else{
                $width = $extend['extend_width'];
            }
            if( empty( $extend['extend_height'] ) || $extend['extend_height'] == 0 || is_null( $extend['extend_height'] ) ){
                $height = $validated[ 'pd_height' ];
            }else{
                $height = $extend['extend_height'];
            }
            $create = ProductDetail::create( [
                'prd_id'             => $new_id ,
                'pd_import_price'    => $price_import ,
                'pd_vat'             => $validated[ 'pd_vat' ] ,
                'pd_price'           => $price ,
                'pd_wholesale_price' => $validated[ 'pd_wholesale_price' ] ,
                'pd_old_price'       => $validated[ 'pd_old_price' ] ,
                'pd_shipping_weight' => $shipping_weight ,
                'pd_unit'            => $validated[ 'pd_unit' ] ,
                'pd_lenght'          => $lenght ,
                'pd_width'           => $width ,
                'pd_height'          => $height ,
                'pd_image'           => $name_file_pd_image ,
                'groupid'            => $arr_general[ 'groupid' ] ,
            ] );
            if($create){
                DB::commit();
                return true;
            }else{
                DB::rollBack();
                return false;
            }
        }catch( \Exception $ex ){
            DB::rollBack();
            return false;
        }
    }
    public function updateProductDetail( $validated , $old_product): bool{
        try{
            DB::beginTransaction();
            $model = ( new ProductDetail() )->findFirstByProductId( $validated[ 'prd_id' ] );
            if( !$model ){
                return true;
            }
            $old_value = $model->toArray();
            $pd_image = $validated[ 'pd_image' ] ?? '';
            if( !empty( $pd_image ) ){
                $file_name = $pd_image->getClientOriginalName();
                $old_image = $model->pd_image;
                if($file_name != $old_image){
                    $upload = checkIsImageAndUpLoad( $pd_image );
                    if( !$upload ){
                        $pd_image = $old_image;
                    }else{
                        unlinkImage($old_image);
                        $pd_image = $upload;
                    }
                }else{
                    $pd_image = $old_image;
                }
            }
            $status = $model->update( [
                'pd_import_price'    => $validated[ 'pd_import_price' ] ,
                'pd_vat'             => $validated[ 'pd_vat' ] ,
                'pd_price'           => $validated[ 'pd_price' ] ,
                'pd_wholesale_price' => $validated[ 'pd_wholesale_price' ] ,
                'pd_old_price'       => $validated[ 'pd_old_price' ] ,
                'pd_shipping_weight' => $validated[ 'pd_shipping_weight' ] ,
                'pd_unit'            => $validated[ 'pd_unit' ] ,
                'pd_lenght'          => $validated[ 'pd_lenght' ] ,
                'pd_width'           => $validated[ 'pd_width' ] ,
                'pd_height'          => $validated[ 'pd_height' ] ,
                'pd_image'           => $pd_image ,
            ] );
            if($status){
                $this->addLog($validated , $old_value , $old_product);
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
    public function updateProductPrice( $product_id , $new_price): bool{
        try{
            DB::beginTransaction();
            $model = ( new ProductDetail() )->findFirstByProductId($product_id);
            if( !$model ){
                return false;
            }
            $status = $model->update( [
                'pd_import_price'    => $new_price ,
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
