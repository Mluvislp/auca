<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Variant\CreateVariantRequest;
use App\Http\Requests\Variant\EditVariantRequest;
use App\Traits\VariantTrait;
use App\Traits\VariantGroupTrait;
use Illuminate\Http\Request;

class VariantController extends Controller {

    use VariantTrait;

    public function getAll( Request $request ){
        return $this->listAllVariant( $request );
    }
    public function editOrder( Request $req ){
        return $this->updateOrderById( $req );
    }
    public function delete( Request $req ){
        return $this->deleteVariant( $req );
    }
    public function create(CreateVariantRequest $req){
        return $this->createNewVariant($req);
    }
    public function edit(EditVariantRequest $req){
        return $this->updateVariant($req);
    }
    public function find(Request $req){
        return $this->findVariantByCategoryId($req);
    }
}
