<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Check;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function check(){
        return view('backend.page.warehouse.check.check');
    }

    public function add_check(){
        return view('backend.page.warehouse.check.add_check');
    }

}
