<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Transfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferNoteController extends Controller
{

    public function transfer_note(){
        return view('backend.page.warehouse.transfer.components.transfer_note');
    }

}