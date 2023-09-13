<?php

namespace App\Http\Controllers\Dashboard\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiktokController extends Controller
{
    public function tiktok(){
        return view('backend.page.store.tiktok.tiktok');
    }
}
