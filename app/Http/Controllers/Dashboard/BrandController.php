<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandModel;

class BrandController extends Controller
{

    public function brand(){
        $brand = BrandModel::orderBy('brand_order','asc')->get();
        return view('backend.page.store.brand.brand',compact('brand'));
    }

    public function add_brand(){
        return view('backend.page.store.brand.add_brand');
    }

    public function edit_brand(){
        return view('backend.page.store.brand.edit_brand');
    }

    public function trash_brand(){
        return view('backend.page.store.brand.trash_brand');
    }
    public function import_brand(){
        return view('backend.page.store.brand.import_brand');
    }
}
