<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryLocationController extends Controller
{
    public function category_location(){
        return view('backend.page.warehouse.location.category_location');
    }

    public function addCategoryLocation(){
        return view('backend.page.warehouse.location.add_category_location');
    }

    public function addLocation(){
        return view('backend.page.warehouse.location.add_location');
    }

}
