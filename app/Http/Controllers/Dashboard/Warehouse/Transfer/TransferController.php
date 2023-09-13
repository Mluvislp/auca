<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Transfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    public function transfer(){
        return view('backend.page.warehouse.transfer.transfer');
    }

}