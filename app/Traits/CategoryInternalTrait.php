<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Imports\CategoryInternalImport;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\CategoryInternal;
use Auth;
use DB;
use JWTAuth;

trait CategoryInternalTrait {
    public function listAllCategoryInternal( $request ){
        $perPage        = $request->input( 'per_page' , 10 );
        $query          = CategoryInternal::query();
        $all_search     = $request->all();
        if( array_key_exists( 'filter_cat_inter_name' , $all_search ) && !empty($all_search['filter_cat_inter_name'])){
            $query->where( 'cat_inter_name' , "LIKE" , "%".$all_search['filter_cat_inter_name']."%" );
        }
        $model = $query->with( 'user' )->withCount( 'categoryInternalProduct' )->orderBy('created_at' , "DESC")->paginate( $perPage );
        if( !$model ){
            return MyHelper::response( false , 'No data found' , [] , 404 );
        }
        $data = [
            'data' => collect( $model->items() )->map( function( $model ){
                $model->user_name = $model->user ? $model->user->user_name : "---";
                unset( $model->user );
                return $model;
            } ) ,
            'total' => $model->total() ,
            'per_page' => $model->perPage() ,
            'current_page' => $model->currentPage() ,
        ];
        return MyHelper::response( true , 'Successfully' , $data , 200 );
    }
    public function exportCategoryInternal( $request ){
        $query          = CategoryInternal::query();
        $all_search     = $request->all();
        if( array_key_exists( 'filter_cat_inter_name' , $all_search ) && !empty($all_search['filter_cat_inter_name'])){
            $query->where( 'cat_inter_name' , "LIKE" , "%".$all_search['filter_cat_inter_name']."%" );
        }
        $model = $query->with( 'user' )->withCount( 'categoryInternalProduct' )->get();
        if( !$model ){
            return MyHelper::response( false , 'No data found' , [] , 404 );
        }
        $data = collect( $model )->map( function( $model ){
            $model->user_name = $model->user ? $model->user->user_name : "---";
            unset( $model->user );
            unset( $model->user_id );
            unset( $model->groupid );
            unset( $model->created_at );
            unset( $model->updated_at );
            unset( $model->deleted_at );
            return [
                $model->cat_inter_name ,
                $model->cat_inter_code ,
                $model->cat_inter_id ,
                $model->cat_inter_parent_id ,
                $model->category_internal_product_count ,
                $model->user_name ,

                ];
        } );
        return MyHelper::response( true , 'Successfully' , $data , 200 );
    }
    public function handleImportCategoryInternal($req){
        try{
            $import = new CategoryInternalImport();
            Excel::import( $import , $req->file( 'fileUpload' ) );
            $total     = $import->getTotal();
            $failures  = $import->getFailures();
            $successes = $import->getSuccesses();
            $fail_data = [];
            if( !empty( $failures ) ){
                foreach( $failures as $failure ){
                    $rowIndex    = $failure[ 'row_index' ];
                    $errors      = $failure[ 'errors' ];
                    $fail_data[] = [
                        'row_index' => $rowIndex ,
                        'errors' => $errors ,
                    ];
                }
            }
            $import_response_data = [
                'success_count' => $successes ,
                'fail_data' => $fail_data ,
                'total_record' => $total ,
            ];
            if( $successes > 0 ){
                return MyHelper::response( true , "Thêm mới liệu thành công" , $import_response_data , 200 );
            }else{
                return MyHelper::response( false , 'Đã có lỗi xảy ra trong quá trình thêm dữ liệu' , $import_response_data , 404 );
            }
        }catch( \Exception $e ){
            return MyHelper::response( false , 'Đã có lỗi xảy ra trong quá trình thêm dữ liệu' , [] , 404 );
        }
    }

    public function createCategoryInternal( $req ){
        $validated = $req->validated();
        $user      = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $new_id = CategoryInternal::insertGetId( [
                'cat_inter_name' => $validated[ 'cat_inter_name' ] ,
                'cat_inter_code' => $validated[ 'cat_inter_code' ] ,
                'cat_inter_parent_id' => $validated[ 'cat_inter_parent_id' ] ,
                'groupid' => $user->groupid ,
                'user_id' => $user->user_id ,
                'created_at' => time() ,
                'updated_at' => time() ,
            ] );
            DB::commit();
            return MyHelper::response( true , 'Tạo mới thành công id : '.$new_id , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , 'Tạo mới thất bại' , [] , 500 );
        }
    }
    public function updateCategoryInternal( $request ){
        $validated = $request->validated();
        try{
            DB::beginTransaction();
            $model = ( new CategoryInternal() )->findFirstById( $validated[ 'cat_inter_id' ] );
            if( !$model ){
                return MyHelper::response( false , 'Không thể cập nhật dữ liệu' , [] , 500 );
            }
            $model->update( [
                'cat_inter_name' => $validated[ 'cat_inter_name' ] ,
                'cat_inter_code' => $validated[ 'cat_inter_code' ] ,
                'cat_inter_parent_id' => $validated[ 'cat_inter_parent_id' ] ,
                'updated_at' => time() ,
            ] );
            DB::commit();
            return MyHelper::response( true , 'Cập nhật thành công id : '.$validated[ 'cat_inter_id' ] , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }
    public function deleteCategoryInternal( $req ){
        $validator = Validator::make( $req->all() , [
            'id' => 'required|integer' ,
        ] );
        if( $validator->fails() ){
            return MyHelper::response( false , 'Kiểm tra lại định dạng dữ liệu' , [] , 404 );
        }
        $req          = $req->all();
        $variantGroup = ( new CategoryInternal() )->findFirstById( $req[ 'id' ] );
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
    public function getCategoryInternal( $id ){
        return ( new CategoryInternal() )->findFirstById( $id );
    }
    public function getIdAndNameCategoryInternal(){
        $categories = ( new CategoryInternal() )->getIdAndNameForCombo();
        if( !$categories ){
            return false;
        }
        return $categories;
    }
}
