<?php

namespace App\Http\Controllers\Dashboard\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function bill(){
        return view('backend.page.warehouse.bill.bill');
    }

    public function import(){
        return view('backend.page.warehouse.bill.import');
    }

    public function export(){
        return view('backend.page.warehouse.bill.export');
    }

    public function transfer(){
        return view('backend.page.warehouse.transfer.transfer');
    }

    public function transfer_note(){
        return view('backend.page.warehouse.transfer.components.transfer_note');
    }

    public function transfer_move(){
        return view('backend.page.warehouse.transfer.transfer_move');
    }

    public function transfer_to_move(){
        return view('backend.page.warehouse.transfer.transfer_to_move');
    }

    public function add_transfer(){
        return view('backend.page.warehouse.transfer.add_transfer');
    }

    public function add_transfer_note(){
        return view('backend.page.warehouse.transfer.add_transfer_note');
    }

    public function call_transfer(){
        return view('backend.page.warehouse.transfer.call_transfer');
    }

}