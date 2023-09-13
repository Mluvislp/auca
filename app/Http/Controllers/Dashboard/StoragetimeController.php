<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoragetimeController extends Controller
{
    public function storagetime(){
        return view('backend.page.store.storagetime.storagetime');
    }
}