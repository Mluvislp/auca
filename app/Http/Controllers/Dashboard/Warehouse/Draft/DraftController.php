<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Draft;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function draft(){
        return view('backend.page.warehouse.draft.draft');
    }

    public function supplier_draft(){
        return view('backend.page.warehouse.draft.supplier_draft');
    }

    public function move_draft(){
        return view('backend.page.warehouse.draft.move_draft');
    }

    public function retail_draft(){
        return view('backend.page.warehouse.draft.retail_draft');
    }

    public function resell_draft(){
        return view('backend.page.warehouse.draft.resell_draft');
    }

    public function other_draft(){
        return view('backend.page.warehouse.draft.other_draft');
    }
}