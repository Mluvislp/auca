<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\BarcodeTraits;
use App\Traits\BrandTrait;
use App\Traits\CategoryInternalTrait;
use App\Traits\CategoryTrait;
use App\Traits\ProductTraits;
use App\Traits\WarehouseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller {
    use ProductTraits , CategoryTrait , BrandTrait , CategoryInternalTrait , WarehouseTrait , BarcodeTraits;

    public function product(){
        $product_type_model      = $this->getAllProductType();
        $product_status_model    = $this->getAllProductStatus();
        $warehouse_model         = $this->getAllWareHouseView();
        $category_model          = $this->getIdAndNameCategoryForCombo();
        $category_internal_model = $this->getIdAndNameCategoryInternal();
        $brand_model             = $this->getBrandForCombobox();
        return view( 'backend.page.store.product.product' , compact( 'product_type_model' , 'product_status_model' , 'warehouse_model' , 'category_model' , 'category_internal_model' , 'brand_model' , ) );
    }

    public function add_product(){
        $product_type_model   = $this->getAllProductType();
        $product_status_model = $this->getAllProductStatus();
        return view( 'backend.page.store.product.add_product' , compact( 'product_type_model' , 'product_status_model' ) );
    }

    public function edit_product( Request $req ){
        $id = $req->query( 'id' );
        if( empty( $id ) || is_null( $id ) || !$id ){
            return redirect( '/notfound' );
        }
        $product = $this->getProduct( $id );
        if( empty( $product ) || is_null( $product ) || !$product ){
            return redirect( '/notfound' );
        }
        $product_status_model = $this->getAllProductStatus();
        return view( 'backend.page.store.product.edit_product' , compact( 'product_status_model' ) );
    }

    public function detail_product( Request $req ){
        $id = $req->query( 'id' );
        if( empty( $id ) || is_null( $id ) || !$id ){
            return redirect( '/notfound' );
        }
        $product = $this->getProduct( $id );
        if( empty( $product ) || is_null( $product ) || !$product ){
            return redirect( '/notfound' );
        }
        $product_status_model = $this->getAllProductStatus();
        return view( 'backend.page.store.product.components.product_info' , compact( 'product_status_model' ) );
    }

    public function barcode( Request $req ){
        $id = $req->query( 'id' );
        if( empty( $id ) || is_null( $id ) || !$id ){
            return redirect( '/notfound' );
        }
        $product = $this->getProductForbarcode( $id );
        if( empty( $product ) || is_null( $product ) || !$product ){
            return redirect( '/notfound' );
        }
        $barcode_html = $this->genBarCode( $product->prd_barcode );
        return view( 'backend.page.store.product.barcode' , compact( 'product' , 'barcode_html' ) );
    }

    public function barcodeExport( Request $req ){
        $id = $req->query( 'id' );
        if( empty( $id ) || is_null( $id ) || !$id ){
            return redirect( '/notfound' );
        }
        $product = $this->getProductForbarcode( $id );
        if( empty( $product ) || is_null( $product ) || !$product ){
            return redirect( '/notfound' );
        }
        $barcode_html = $this->genBarCode( $product->prd_barcode );
        return view( 'backend.page.store.product.barcode' , compact( 'product' , 'barcode_html' ) );
    }

    public function trash_product(){
        return view( 'backend.page.store.product.trash_product' );
    }

    public function sell_price(){
        return view( 'backend.page.store.product.view_sell_price' );
    }

    public function import_price(){
        return view( 'backend.page.store.product.view_import_price' );
    }

    public function edit_history(){
        return view( 'backend.page.store.product.view_edit_history' );
    }

}