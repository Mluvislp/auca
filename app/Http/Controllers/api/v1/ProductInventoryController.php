<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Traits\ProductInventoryTraits;
use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    use ProductInventoryTraits;
    public function getListProductInventory(Request $request){
        return $this->ListAll($request);
    }
    public function getHeadDatatables(Request $request){
        return $this->getHead($request);
    }
}
