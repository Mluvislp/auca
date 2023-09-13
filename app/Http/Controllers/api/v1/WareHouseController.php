<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\CreateWarehouseRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Traits\WarehouseTrait;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    use WarehouseTrait;
    public function getList(Request $request){
        return $this->getListWarehouse($request);
    }
    public function create(CreateWarehouseRequest $request){
        $validated = $request->validated();
        return $this->createNewWarehouse($validated);
    }
    public function update(UpdateWarehouseRequest $request){
        $validated = $request->validated();
        return $this->updateWarehouse($validated);
    }
    public function getInfo(Request $request){
        return $this->getInfoWarehouse($request);
    }
    public function delete(Request $request){
        return $this->deleteWarehouse($request);
    }
    public function getAll(Request $request){
        return $this->getAllWareHouse($request);
    }
    public function getSelect(Request $request){
        return $this->getSelectWare($request);
    }
}
