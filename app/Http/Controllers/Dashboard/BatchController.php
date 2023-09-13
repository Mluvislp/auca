<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function batch(){
        return view('backend.page.store.batch.batch');
    }

    public function add_batch(){
        return view('backend.page.store.batch.add_batch');
    }

    public function edit_batch(){
        return view('backend.page.store.batch.edit_batch');
    }
    public function import_batch(){
        return view('backend.page.store.batch.import_batch');
    }

}