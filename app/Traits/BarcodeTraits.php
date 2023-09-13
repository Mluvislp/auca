<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\Product;
use App\Models\WarehouseProduct;
use Auth;
use JWTAuth;
use Milon\Barcode\DNS1D;

trait BarcodeTraits {
    public function genBarCode($bar_code ,  $barcodeType = 'C128'){
        $barcode = new DNS1D();
        return $barcode->getBarcodeHTML($bar_code, $barcodeType);
    }
}
