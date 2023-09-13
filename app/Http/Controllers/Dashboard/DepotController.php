<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function depot() {
        return view('backend.page.depot.depot');
    }

    public function add_depot(){
        return view('backend.page.depot.add_depot');
    }

    public function edit_depot(){
        return view('backend.page.depot.edit_depot');
    }
}
