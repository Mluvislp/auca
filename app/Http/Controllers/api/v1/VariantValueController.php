<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Variant\CreateVariantValueRequest;
use App\Http\Requests\Variant\EditVariantValueRequest;
use App\Traits\VariantValueTrait;
use Illuminate\Http\Request;

class VariantValueController extends Controller
{
    use VariantValueTrait;
    public function getAll(Request $request){
        return $this->listAlVariantValue($request);
    }
    public function create(CreateVariantValueRequest $req){
        return $this->createNewVariantValue($req);
    }
    public function editOrder( Request $req ){
        return $this->updateOrderVariantValueById( $req );
    }
    public function delete( Request $req ){
        return $this->deleteVariantValue( $req );
    }
    public function edit(EditVariantValueRequest $req){
        return $this->updateVariantValue($req);
    }
}
