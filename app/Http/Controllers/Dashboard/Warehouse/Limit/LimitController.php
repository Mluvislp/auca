<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Limit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LimitController extends Controller
{
    public function limit(){
        return view('backend.page.warehouse.limit.limit');
    }

    public function add_limit(){
        return view('backend.page.warehouse.limit.add_limit');
    }
}