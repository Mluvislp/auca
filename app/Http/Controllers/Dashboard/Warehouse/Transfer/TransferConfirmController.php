<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Transfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferConfirmController extends Controller
{
    public function transfer_confirm(){
        return view('backend.page.warehouse.transfer.components.transfer_confirm');
    }
}
