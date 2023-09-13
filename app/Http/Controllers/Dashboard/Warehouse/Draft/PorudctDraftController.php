<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Draft;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PorudctDraftController extends Controller
{
    public function draft_product(){
        return view('backend.page.warehouse.draft.draft_product');
    }

    public function ncc_draft(){
        return view('backend.page.warehouse.draft.ncc_draft');
    }

    public function moveTo_draft(){
        return view('backend.page.warehouse.draft.moveTo_draft');
    }

    public function nnk_retail_draft(){
        return view('backend.page.warehouse.draft.nnk_retail_draft');
    }

    public function nnk_resell_draft(){
        return view('backend.page.warehouse.draft.nnk_resell_draft');
    }

    public function nnk_other_draft(){
        return view('backend.page.warehouse.draft.nnk_other_draft');
    }
}
