<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductPackageController extends Controller
{
    public function add(){
        return view('backend.page.store.product_package.add');
    }

    public function unbox(){
        return view('backend.page.store.product_package.unbox');
    }
}
