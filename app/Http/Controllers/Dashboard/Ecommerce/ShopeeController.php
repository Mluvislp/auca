<?php

namespace App\Http\Controllers\Dashboard\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopeeController extends Controller
{
    public function shopee(){
        return view('backend.page.store.shopee.shopee');
    }
}
