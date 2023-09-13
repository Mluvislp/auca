<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Variant\CreatVariantGroupRequest;
use App\Http\Requests\Variant\EditVariantGroupRequest;
use App\Traits\VariantGroupTrait;
use Illuminate\Http\Request;

class VariantGroupController extends Controller
{
    use VariantGroupTrait;
    public function getAll(Request $request){
        return $this->listAlVariantGroup($request);
    }
    public function editOrder( Request $req ){
        return $this->updateOrderVariantGroupById( $req );
    }
    public function delete( Request $req ){
        return $this->deleteVariantGroup( $req );
    }
    public function create(CreatVariantGroupRequest $req){
        return $this->createNewVariantGroup($req);
    }
    public function edit(EditVariantGroupRequest $req){
        return $this->updateVariantGroup($req);
    }
}
