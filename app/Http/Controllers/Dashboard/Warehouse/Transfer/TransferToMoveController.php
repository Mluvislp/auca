<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Transfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferToMoveController extends Controller
{

    public function transfer_to_move(){
        return view('backend.page.warehouse.transfer.components.transfer_to_move');
    }

}