<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function location(){
        return view('backend.page.warehouse.location.location');
    }

    public function putIn(){
        return view('backend.page.warehouse.location.put_in');
    }

    public function putOut(){
        return view('backend.page.warehouse.location.put_out');
    }

}
