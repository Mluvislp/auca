<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\CategoryTagTrait;
use App\Traits\CategoryTrait;
use App\Traits\CatTagTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use CategoryTrait , CatTagTrait ;
    public function category(){
        return view('backend.page.store.category.category');
    }

    public function add_category(Request $request){
        $categories = $this->getIdAndNameCategoryForCombo();
        $cat_tag = $this->getListCatTag();
        $hideViewPartial = $request->input('hideViewPartial');
        return view('backend.page.store.category.add_category' , compact('categories' ,'cat_tag' , 'hideViewPartial'));
    }

    public function edit_category(Request $req){
        $id = $req->query('id');
        if( empty( $id ) || is_null( $id ) || !$id ){
            return redirect( '/notfound' );
        }
        $category = $this->getCategory($id);
        if( empty( $category ) || is_null( $category ) || !$category ){
            return redirect( '/notfound' );
        }
        $categories = $this->getIdAndNameCategoryForCombo($id);
        $cat_tag = $this->getListCatTag();
        $cat_tag_selected = $this->getAllByCategory($id);
        $arr_cat_tag = [];
        if($cat_tag_selected){
            $cat_tag_selected = $cat_tag_selected->toArray();
            foreach( $cat_tag_selected as $item ){
                $arr_cat_tag[] = $item[ 'ctag_id' ];
            };
        }
        return view('backend.page.store.category.edit_category' , compact('category' , 'categories' , 'cat_tag' , 'arr_cat_tag'));
    }

    public function trash_category(){
        return view('backend.page.store.category.trash_category');
    }

    public function import(){
        return view('backend.page.store.category.importexcel_category');
    }
}
