<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CategoryInternal;
use App\Traits\CategoryInternalTrait;
use App\Traits\GroupTrait;
use Illuminate\Http\Request;

class CategoryInternalController extends Controller
{
    use GroupTrait , CategoryInternalTrait;
    public function categoryInternal(){
        return view('backend.page.store.category.category_internal');
    }
    public function create(){
        $model_group = $this->getGroup();
        $category_internal       = CategoryInternal::with( 'recursiveChildren' )->whereNull( 'cat_inter_parent_id' )->get();
        return view('backend.page.store.category.add_category_internal' , compact('model_group' , 'category_internal'));
    }
    public function edit( Request $request ){
        $id = $request->query( 'id' );
        if( empty( $id ) || is_null( $id ) ){
            return redirect( '/notfound' );
        }
        $category_internal_model = $this->getCategoryInternal( $id );
        $model_group = $this->getGroup();
        $category_internal       = CategoryInternal::with( 'recursiveChildren' )->whereNull( 'cat_inter_parent_id' )->get();
        if( $category_internal_model ){
            return view( 'backend.page.store.category.edit_category_internal' , compact(
                'category_internal' ,
                'category_internal_model' , 'model_group')
            );
        }else{
            return redirect( '/notfound' );
        }
    }
    public function import(){
        return view('backend.page.store.category.importexcel_categoryinternal');
    }
}
