<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Variant\CreatVariantGroupRequest;
use App\Http\Requests\Variant\EditVariantGroupRequest;
use App\Traits\VariantGroupTrait;
use App\Traits\VariantTrait;
use Illuminate\Http\Request;

class VariantGroupController extends Controller
{
    use VariantTrait , VariantGroupTrait;
    public function createGroup(){
        return view( 'backend.page.store.variant.creategroup' );
    }
    public function editGroup( Request $request ){
        $id = $request->query( 'id' );
        if( empty( $id ) || is_null( $id ) ){
            return redirect( '/notfound' );
        }
        $variant_group = $this->getVariantGroup( $id );
        if( $variant_group ){
            return view( 'backend.page.store.variant.editgroup' , compact( 'variant_group' ) );
        }else{
            return redirect( '/notfound' );
        }
    }
}
