<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillLocationController extends Controller
{
    public function bill_location(){
        return view('backend.page.warehouse.location.bill_location');
    }
}