<?php

namespace App\Http\Controllers\Dashboard\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TikiController extends Controller
{
    public function tiki(){
        return view('backend.page.store.tiki.tiki');
    }
}
