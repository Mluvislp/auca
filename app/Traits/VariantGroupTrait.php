<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\VariantGroup;
use Auth;
use DB;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\String\length;

trait VariantGroupTrait {
    public function listAlVariantGroup( $request ){
        $keyword = $request->input( 'search' );
        $perPage = $request->input( 'per_page' , 10 );
        $query   = VariantGroup::query();
        if( !empty( $keyword ) ){
            $query->where( 'vg_name' , 'LIKE' , "%$keyword%" );
        }
        $all_search = $request->all();
        if( array_key_exists( 'columns' , $all_search ) ){
            foreach( $all_search[ 'columns' ] as $val ){
                if( is_null( $val[ 'search' ][ 'value' ] ) || !$val[ 'searchable' ] ){
                    continue;
                }else{
                    $operator        = ( $val[ 'name' ] == 'vg_id' ? '=' : 'LIKE' );
                    $percent_percent = ( $val[ 'name' ] == 'vg_id' ? "" : "%" );
                    $query->where( $val[ 'name' ] , $operator , $percent_percent.$val[ 'search' ][ 'value' ].$percent_percent );
                }
            }
        }
        if( $request->has( 'vg_id' ) ){
            $query->where( 'vg_id' , '=' , $request->input( 'vg_id' ) );
        }
        $variantGroups = $query->with( 'user' )->orderBy('created_at' , "DESC")->paginate( $perPage );
        if( !$variantGroups ){
            return MyHelper::response( false , 'No data found' , [] , 404 );
        }
        $data = [
            'data' => collect( $variantGroups->items() )->map( function( $variantGroup ){
                $variantGroup->user_name = $variantGroup->user ? $variantGroup->user->user_name : "---";
                unset( $variantGroup->user );
                return $variantGroup;
            } ) ,
            'total' => $variantGroups->total() ,
            'per_page' => $variantGroups->perPage() ,
            'current_page' => $variantGroups->currentPage() ,
        ];
        return MyHelper::response( true , 'Successfully' , $data , 200 );
    }

    public function updateOrderVariantGroupById( $req ){
        foreach( $req->all() as $key => $val ){
            if( !is_int( $key ) ){
                return MyHelper::response( false , 'Dữ liệu đầu vào không hợp lệ' , [] , 404 );
            };
            if( $val !== null && is_numeric( $val ) ){
                $req[ (int)$key ] = (int)$val;
            }else{
                $req[ (int)$key ] = $val;
            }
        }
        if( empty( $req ) || is_null( $req ) ){
            return MyHelper::response( false , 'Không có dữ liệu đầu vào' , [] , 404 );
        }
        $result = [];
        foreach( $req->all() as $key => $val ){
            $variantGroup = ( new VariantGroup() )->findFirstById( $key );
            if( !$variantGroup ){
                $result[ $key ] = [
                    'status' => false ,
                ];
            }else{
                if((int)$val < 0){
                    $result[ $key ] = [
                        'status' => false ,
                    ];
                }else{
                    if( $variantGroup[ 'vg_order' ] !== $val ){
                        $update = $variantGroup->update( [ 'vg_order' => $val ] );
                        if( !$update ){
                            $result[ $key ] = [
                                'status' => false ,
                            ];
                        }else{
                            $result[ $key ] = [
                                'status' => true ,
                            ];
                        }
                    }
                }
            }
        }
        if( empty( $result ) ){
            return MyHelper::response( false , 'Không có dữ liệu được thay đổi' , [] , 404 );
        }
        return MyHelper::response( true , 'Successfully' , $result , 200 );
    }

    public function deleteVariantGroup( $req ){
        $validator = Validator::make( $req->all() , [
            'id' => 'required|integer' ,
        ] );
        if( $validator->fails() ){
            return MyHelper::response( false , 'Kiểm tra lại định dạng dữ liệu' , [] , 404 );
        }
        $req          = $req->all();
        $variantGroup = ( new VariantGroup() )->findFirstById( $req[ 'id' ] );
        if( !$variantGroup ){
            return MyHelper::response( false , 'Không tìm thấy dữ liệu' , [] , 404 );
        }
        $deleted = $variantGroup->delete();
        if( $deleted ){
            return MyHelper::response( true , 'Xoá thành công id : '.$req[ 'id' ] , [] , 200 );
        }else{
            return MyHelper::response( false , 'Không thành công' , [] , 404 );
        }
    }
    public function getIdAndNameVariantGroup(){
        $cat_group = ( new VariantGroup() )->getIdAndName();
        if( !$cat_group ){
            return false;
        }
        return $cat_group;
    }
    public function createNewVariantGroup( $request ){
        $validated = $request->validated();
        $user      = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $vg_id = VariantGroup::insertGetId( [
                'vg_name' => $validated[ 'vg_name' ] ,
                'vg_order' => $validated[ 'vg_order' ] ,
                'user_id' => $user->user_id ,
                'groupid' => $user->groupid ,
                'created_at' => time() ,
                'updated_at' => time() ,
            ] );
            DB::commit();
            return MyHelper::response( true , 'Tạo mới thành công id : '.$vg_id , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function updateVariantGroup( $request ){
        $validated = $request->validated();
        $user      = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $vg = ( new VariantGroup() )->getById( $validated[ 'vg_id' ] );
            if( !$vg ){
                return MyHelper::response( false , 'Không thể cập nhật dữ liệu' , [] , 500 );
            }
            $vg->update( [
                'vg_name' => $validated[ 'vg_name' ] ,
                'vg_order' => $validated[ 'vg_order' ] ,
                'updated_at' => time() ,
            ] );
            DB::commit();
            return MyHelper::response( true , 'Cập nhật thành công id : '.$validated[ 'vg_id' ]  , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function getVariantGroup( $id ){
        return ( new VariantGroup() )->getById( $id );
    }
}
