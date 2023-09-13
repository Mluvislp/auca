<?php

namespace App\Http\Controllers\Dashboard\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LazadaController extends Controller
{
    public function lazada(){
        return view('backend.page.store.lazada.lazada');
    }

    public function connector(){
        return view('backend.page.store.lazada.lazadaConnector');
    }
    
}
