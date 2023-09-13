<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Check;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCheckController extends Controller
{
    public function product_check(){
        return view('backend.page.warehouse.check.product_check');
    }
}