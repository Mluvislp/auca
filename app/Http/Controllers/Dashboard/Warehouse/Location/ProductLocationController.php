<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductLocationController extends Controller
{
    public function product_location(){
        return view('backend.page.warehouse.location.product_location');
    }
}