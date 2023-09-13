<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;

use App\Models\Group;
use Auth;
use DB;
use Illuminate\Support\Facades\Request;
use JWTAuth;

trait GroupTrait {
    public function checkExist(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $group_id_user = $user->groupid;
        if(empty($group_id_user)){
            return MyHelper::response( false , 'The account has not yet created a company' , [] , 200 );
        }
        $group = Group::where('id' , $group_id_user)->first();
        if(!$group){
            return MyHelper::response( false , 'Company not found' , [] , 404 );
        }else{
            return MyHelper::response( true , 'Success' , $group , 200 );
        }
    }
    public function create($validated){
        try{
            $user = JWTAuth::parseToken()->authenticate();
            Group::create([
                'group_name'  => $validated[ 'group_name' ] ,
                'tax_code'    => $validated[ 'tax_code' ] ,
                'address'     => $validated[ 'address' ] ,
                'email'       => $validated[ 'email' ] ,
                'phone'       => $validated[ 'phone' ] ,
                'description' => $validated[ 'description' ] ,
                'createby'   => $user->user_id,
                'datecreate' => time(),
            ]);
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }
    public function update($validated){
        try{
            $group = Group::where('id' , $validated['group_id'])->first();
            if(!$group){
                return MyHelper::response( false , 'Company not found' , [] , 404 );
            }
            $group->update([
                'group_name' => $validated['group_name'],
                'tax_code'   => $validated[ 'tax_code' ],
                'address'    => $validated[ 'address' ],
                'email'      => $validated[ 'email' ],
                'phone'      => $validated[ 'phone' ],
                'dateupdate' => time(),
            ]);
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }
    public function getAllGroup($request){
        try{
            $query      = Group::query();
            $all_search = $request->all();
            if( array_key_exists( 'filter_group_name' , $all_search ) && !empty($all_search['filter_group_name']) ){
                $query->where('group_name' , 'LIKE' , '%'.$all_search['filter_group_name'].'%');
            }
            $list = $query->get();
            return MyHelper::response( true , 'Successfully' , $list , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function getGroup(){
        $group_id = \Illuminate\Support\Facades\Auth::user()->groupid;
        $group    = ( new Group() )->getById( $group_id );
        if( !$group ){
            return false;
        }
        return $group;
    }
}
