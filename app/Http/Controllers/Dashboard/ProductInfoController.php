<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductInfoController extends Controller
{
    public function product_info(){
        return view('backend.page.store.product.components.product_info');
    }
}
