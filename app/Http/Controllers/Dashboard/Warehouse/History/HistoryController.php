<?php

namespace App\Http\Controllers\Dashboard\Warehouse\History;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history(){
        return view('backend.page.warehouse.history.history');
    }
}
