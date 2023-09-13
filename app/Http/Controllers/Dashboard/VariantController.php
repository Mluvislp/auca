<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Variant\CreateVariantRequest;
use App\Http\Requests\Variant\CreatVariantGroupRequest;
use App\Http\Requests\Variant\EditVariantGroupRequest;
use App\Http\Requests\Variant\EditVariantRequest;
use App\Models\Category;
use App\Models\Variant;
use App\Models\VariantCategory;
use App\Traits\CategoryTrait;
use App\Traits\VariantGroupTrait;
use App\Traits\VariantTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller {
    use CategoryTrait;
    use VariantTrait , VariantGroupTrait;

    public function variant(){
        $categories    = Category::with( 'recursiveChildren' )->whereNull( 'cat_parent_id' )->get();
        $variant_group = $this->getIdAndNameVariantGroup();
        return view( 'backend.page.store.variant.variant' ,compact('categories' , 'variant_group'));
    }

    public function create(Request $request){
        $categories    = Category::with( 'recursiveChildren' )->whereNull( 'cat_parent_id' )->get();
        $variant       = Variant::with( 'recursiveChildren' )->whereNull( 'var_parent_id' )->get();
        $variant_group = $this->getIdAndNameVariantGroup();
        $hideViewPartial = $request->input('hideViewPartial');
        return view( 'backend.page.store.variant.create' , compact( 'categories' , 'variant_group' , 'variant', 'hideViewPartial' ) );
    }

    public function edit( Request $request ){
        $categories    = Category::with( 'recursiveChildren' )->whereNull( 'cat_parent_id' )->get();
        $variant       = Variant::with( 'recursiveChildren' )->whereNull( 'var_parent_id' )->get();
        $variant_group = $this->getIdAndNameVariantGroup();
        $id            = $request->query( 'id' );
        if( empty( $id ) || is_null( $id ) ){
            return redirect( '/notfound' );
        }
        $get_selected_category =  DB::table((new VariantCategory())->getTable().' as v')
            ->join((new Category())->getTable().' as c', 'c.cat_id', '=', 'v.cat_id')
            ->where('v.var_id' , '=',$id)
            ->select('v.*', 'c.cat_name')
            ->get();
        $selected_category = [];
        foreach($get_selected_category as $val){
            array_push($selected_category , $val->cat_id);
        }
        $variant_model = $this->getVariant( $id );
        if( $variant_model ){
            return view( 'backend.page.store.variant.edit' , compact( 'categories' , 'variant_group' , 'variant' , 'variant_model' ,'selected_category') );
        }else{
            return redirect( '/notfound' );
        }
    }
}
