<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductBarcodeController extends Controller
{
    public function barcode_product(){
        return view('backend.page.store.product.components.product_barcode');
    }
}
