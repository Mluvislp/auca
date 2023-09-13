<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Traits\CategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use CategoryTrait;
    public function getAll( Request $request ){
        return $this->listAllCategory($request);
    }
    public function editOrder( Request $req ){
        return $this->updateOrderCategoryById( $req );
    }
    public function create(CreateCategoryRequest $req){
        return $this->createCategory($req);
    }
    public function import( Request $req ){
        return $this->handleImportCategory( $req );
    }
    public function delete( Request $req ){
        return $this->deleteCategory( $req );
    }
    public function edit( EditCategoryRequest $req ){
        return $this->updateCategoryById( $req );
    }
}
