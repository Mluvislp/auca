<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryInternalRequest;
use App\Http\Requests\Category\EditCategoryInternalRequest;
use App\Traits\CategoryInternalTrait;
use Illuminate\Http\Request;

class CategoryInternalController extends Controller
{
    use CategoryInternalTrait;
    public function getAll(Request $req){
        return $this->listAllCategoryInternal($req);
    }
    public function create(CreateCategoryInternalRequest $req){
        return $this->createCategoryInternal($req);
    }
    public function edit(EditCategoryInternalRequest $req){
        return $this->updateCategoryInternal($req);
    }
    public function delete( Request $req ){
        return $this->deleteCategoryInternal( $req );
    }
    public function export( Request $req ){
        return $this->exportCategoryInternal( $req );
    }
    public function import( Request $req ){
        return $this->handleImportCategoryInternal( $req );
    }
}
