<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\Warehouse;
use Auth;
use DB;
use JWTAuth;
use Illuminate\Support\Facades\Validator;


trait WarehouseTrait {
    public function getListWarehouse($request){
        $perPage        = $request->input( 'per_page' , 10 );
        $query          = Warehouse::query();
        $supplier = $query->with( 'user' )->orderBy('created_at' , "DESC")->paginate( $perPage );
        if( !$supplier ){
            return MyHelper::response( false , 'No data found' , [] , 404 );
        }
        $data = [
            'data' => collect( $supplier->items() )->map( function( $supplier ){
                $supplier->user_name = $supplier->user ? $supplier->user->user_name : "---";
                unset( $supplier->user );
                return $supplier;
            } ) ,
            'total' => $supplier->total() ,
            'per_page' => $supplier->perPage() ,
            'current_page' => $supplier->currentPage() ,
        ];
        return MyHelper::response( true , 'Successfully' , $data , 200 );
    }
    public function createNewWarehouse( $validated ){
        $user      = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $vg_id = Warehouse::insertGetId( [
                'w_name'     => $validated[ 'w_name' ] ,
                'w_mobile'   => $validated[ 'w_mobile' ] ,
                'w_address'  => $validated[ 'w_address' ] ,
                'user_id'    => $user->user_id ,
                'groupid'    => $user->groupid ,
                'created_at' => time() ,
            ] );
            DB::commit();
            return MyHelper::response( true , 'Tạo mới thành công id : '.$vg_id , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }
    public function updateWarehouse( $validated ){
        try{
            DB::beginTransaction();
            $vg = ( new Warehouse() )->findFirstById( $validated[ 'w_id' ] );
            if( !$vg ){
                return MyHelper::response( false , 'Không thể cập nhật dữ liệu' , [] , 500 );
            }
            $vg->update( [
                'w_name'     => $validated[ 'w_name' ] ,
                'w_mobile'   => $validated[ 'w_mobile' ] ,
                'w_address'  => $validated[ 'w_address' ] ,
                'updated_at' => time() ,
            ] );
            DB::commit();
            return MyHelper::response( true , 'Cập nhật thành công id : '.$validated[ 'w_id' ]  , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }
    public function getInfoWarehouse($req){
        $validator = Validator::make( $req->all() , [
            'id' => 'required|integer' ,
        ] );
        if( $validator->fails() ){
            return MyHelper::response( false , 'Kiểm tra lại định dạng dữ liệu' , [] , 404 );
        }
        $req          = $req->all();
        $w = ( new Warehouse() )->findFirstById( $req[ 'id' ] );
        if( !$w ){
            return MyHelper::response( false , 'Không tìm thấy dữ liệu' , [] , 404 );
        }
        return MyHelper::response( true , 'Success' , $w, 200 );
    }
    public function deleteWarehouse( $req ){
        $validator = Validator::make( $req->all() , [
            'id' => 'required|integer' ,
        ] );
        if( $validator->fails() ){
            return MyHelper::response( false , 'Kiểm tra lại định dạng dữ liệu' , [] , 404 );
        }
        $req          = $req->all();
        $w = ( new Warehouse() )->findFirstById( $req[ 'id' ] );
        if( !$w ){
            return MyHelper::response( false , 'Không tìm thấy dữ liệu' , [] , 404 );
        }
        $deleted = $w->delete();
        if( $deleted ){
            return MyHelper::response( true , 'Xoá thành công id : '.$req[ 'id' ] , [] , 200 );
        }else{
            return MyHelper::response( false , 'Không thành công' , [] , 404 );
        }
    }
    public function getAllWareHouse($request){
        try{
            $query      = Warehouse::query();
            $all_search = $request->all();
            if( array_key_exists( 'filter_w_name' , $all_search ) && !empty($all_search['filter_w_name']) ){
                $query->where('w_name' , 'LIKE' , '%'.$all_search['filter_w_name'].'%');
            }
            $list = $query->get();
            return MyHelper::response( true , 'Successfully' , $list , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }
    public function getAllWareHouseView(){
            return (new Warehouse())->getIdAndName();
    }
    public function getSelectWare($request){
        try{
            $query      = Warehouse::query();
            $all_search = $request->all();
            $list = $query->get();
            return MyHelper::response( true , 'Successfully' , $list , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }
}
