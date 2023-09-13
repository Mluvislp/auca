<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\CreateWarehouseBillRequest;
use App\Traits\WarehouseBillTrait;
use Illuminate\Http\Request;

class WarehouseBillController extends Controller
{
    use WarehouseBillTrait;
    public function listAll(Request $request){
        return $this->getAllWareHouseBill($request);
    }
    public function listWareHouseBillProduct(Request $request){
        return $this->getAllWareHouseBillProduct($request);
    }
    public function create(CreateWarehouseBillRequest $request){
        $validated = $request->validated();
        return $this->createWareHouseBill($validated);
    }
}
