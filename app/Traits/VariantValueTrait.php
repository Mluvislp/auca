<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\VariantValue;
use Auth;
use DB;
use JWTAuth;
use Illuminate\Support\Facades\Validator;

trait VariantValueTrait {
    public function listAlVariantValue( $request ){
        $keyword = $request->input( 'search' );
        $perPage = $request->input( 'per_page' , 10 );
        $var_id  = $request->query( 'var_id' );
        if( empty( $var_id ) ){
            return MyHelper::response( false , 'No data found' , [] , 404 );
        }
        $query = VariantValue::query()->where( 'var_id' , $var_id );
        if( !empty( $keyword ) ){
            $query->where( 'vv_name' , 'LIKE' , "%$keyword%" );
        }
        $all_search = $request->all();
        if( array_key_exists( 'columns' , $all_search ) ){
            foreach( $all_search[ 'columns' ] as $val ){
                if( is_null( $val[ 'search' ][ 'value' ] ) || !$val[ 'searchable' ] ){
                    continue;
                }else{
                    $operator        = ( $val[ 'name' ] == 'vv_id' ? '=' : 'LIKE' );
                    $percent_percent = ( $val[ 'name' ] == 'vv_id' ? "" : "%" );
                    $query->where( $val[ 'name' ] , $operator , $percent_percent.$val[ 'search' ][ 'value' ].$percent_percent );
                }
            }
        }
        $variantGroups = $query->with( 'user' )->orderBy('vv_id' , "DESC")->paginate( $perPage );
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

    public function updateOrderVariantValueById( $req ){
        foreach( $req->all() as $key => $val ){
            if( !is_int( $key ) ){
                return MyHelper::response( false , 'Dữ liệu đầu vào không hợp lệ' , [] , 404 );
            }
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
            $variantGroup = ( new VariantValue() )->findFirstById( $key );
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
                    if( $variantGroup[ 'vv_order' ] !== $val ){
                        $update = $variantGroup->update( [ 'vv_order' => $val ] );
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

    public function deleteVariantValue( $req ){
        $validator = Validator::make( $req->all() , [
            'id' => 'required|integer' ,
        ] );
        if( $validator->fails() ){
            return MyHelper::response( false , 'Kiểm tra lại định dạng dữ liệu' , [] , 404 );
        }
        $req          = $req->all();
        $variantGroup = ( new VariantValue() )->findFirstById( $req[ 'id' ] );
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

    public function createNewVariantValue( $request ){
        $validated = $request->validated();
        $user      = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $vg_id = VariantValue::insertGetId( [
                'var_id' => $validated[ 'var_id' ] ,
                'vv_name' => $validated[ 'vv_name' ] ,
                'vv_parent_id' => $validated[ 'vv_parent_id' ] ,
                'vv_value' => $validated[ 'vv_value' ] ,
                'vv_other_name' => $validated[ 'vv_other_name' ] ,
                'vv_code' => $validated[ 'vv_code' ] ,
                'vv_other_code' => $validated[ 'vv_other_code' ] ,
                'vv_unit' => $validated[ 'vv_unit' ] ,
                'vv_order' => $validated[ 'vv_order' ] ,
                'groupid' => $user->groupid ,
                'user_id' => $user->user_id ,
            ] );
            DB::commit();
            return MyHelper::response( true , 'Tạo mới thành công id : '.$vg_id , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function updateVariantValue( $request ){
        $validated = $request->validated();
        try{
            DB::beginTransaction();
            $model = ( new VariantValue() )->getById( $validated[ 'vv_id' ] );
            if( !$model ){
                return MyHelper::response( false , 'Không thể cập nhật dữ liệu' , [] , 500 );
            }
            $model->update( [
                'vv_name' => $validated[ 'vv_name' ] ,
                'vv_parent_id' => $validated[ 'vv_parent_id' ] ,
                'vv_value' => $validated[ 'vv_value' ] ,
                'vv_other_name' => $validated[ 'vv_other_name' ] ,
                'vv_code' => $validated[ 'vv_code' ] ,
                'vv_other_code' => $validated[ 'vv_other_code' ] ,
                'vv_unit' => $validated[ 'vv_unit' ] ,
                'vv_order' => $validated[ 'vv_order' ] ,
            ] );
            DB::commit();
            return MyHelper::response( true , 'Cập nhật thành công id : '.$validated[ 'vv_id' ] , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function getIdAndNameVariantValue(){
        $categories = ( new VariantValue() )->getIdAndName();
        if( !$categories ){
            return false;
        }
        return $categories;
    }

    public function getVariantValue( $id ){
        return ( new VariantValue() )->getById( $id );
    }
}
