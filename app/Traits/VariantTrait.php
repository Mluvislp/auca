<?php

namespace App\Traits;

use App\Http\Functions\CheckField;
use App\Http\Functions\MyHelper;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantCategory;
use App\Models\VariantGroup;
use Auth;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;

trait VariantTrait {
    public function listAllVariant ($request) {
        $perPage    = $request->input('per_page', 10);
        $query      = Variant::query();
        $all_search = $request->all();
        $arr_col_filter = [
            'var_id',
            'var_name',
        ];
        //Lọc theo giá trị của các cột trong bảng
        if(array_key_exists('columns', $all_search)){
            $filteredColumns = [];
            foreach ($all_search[ 'columns' ]  as $column) {
                if (in_array($column['data'], $arr_col_filter)) {
                    $filteredColumns[] = $column;
                }
            }
            if(!empty($filteredColumns)){
                foreach($filteredColumns as $val){
                    if( !isset($val[ 'search' ][ 'value' ]) || is_null($val[ 'search' ][ 'value' ]) || !$val[ 'searchable' ]){
                        continue;
                    }
                    else{
                        $operator        = ( $val[ 'name' ] == 'var_id' ? '=' : 'LIKE' );
                        $percent_percent = ( $val[ 'name' ] == 'var_id' ? "" : "%" );
                        $query->where($val[ 'name' ], $operator, $percent_percent . $val[ 'search' ][ 'value' ] . $percent_percent);
                    }
                }
            }
        }
        // Lọc theo category
        if (array_key_exists('selected_var_cat_id', $all_search)) {
            $query->whereHas('variantCategories', function ($q) use ($all_search) {
                $q->whereIn('cat_id', $all_search['selected_var_cat_id']);
            });
        }
        // Lọc theo variant group
        if(array_key_exists('selected_var_gr_id', $all_search)){
            foreach($all_search['selected_var_gr_id'] as $val){
                $query->where(function ($query) use($val) {
                    $query->where('vg_id', $val);
                });
            }
        }
        //Chạy
        $variant = $query->with('user')->withCount('variantValues')->orderBy('created_at' , "DESC")->paginate($perPage);
        if(!$variant){
            return MyHelper::response(false, 'No data found', [], 404);
        }
        $data = [
            'data'         => collect($variant->items())->map(function($variant) {
                $variant->user_name = $variant->user ? $variant->user->user_name : "---";
                unset($variant->user);
                return $variant;
            }),
            'total'        => $variant->total(), 'per_page' => $variant->perPage(),
            'current_page' => $variant->currentPage(),
        ];
        return MyHelper::response(true, 'Successfully', $data, 200);
    }

    public function updateOrderById ($req) {
        foreach($req->all() as $key=>$val){
            if(!is_int($key)){
                return MyHelper::response(false, 'Dữ liệu đầu vào không hợp lệ', [], 404);
            };
            if ($val !== null && is_numeric($val)) {
                $req[(int)$key] = (int)$val;
            } else {
                $req[(int)$key] = $val;
            }
        }
        if(empty($req) || is_null($req)){
            return MyHelper::response(false, 'Không có dữ liệu đầu vào', [], 404);
        }
        $result = [];
        foreach($req->all() as $key => $val){
            $variant = ( new Variant() )->findFirstById($key);
            if(!$variant){
                $result[ $key ] = [
                    'status' => false,
                ];
            }
            else{
                if((int)$val < 0){
                    $result[ $key ] = [
                        'status' => false ,
                    ];
                }else{
                    if($variant['var_order'] !== $val){
                        $update = $variant->update([ 'var_order' => $val ]);
                        if(!$update){
                            $result[ $key ] = [
                                'status' => false,
                            ];
                        }else{
                            $result[ $key ] = [
                                'status' => true,
                            ];
                        }
                    }
                }
            }
        }
        if(empty($result)){
            return MyHelper::response(false, 'Không có dữ liệu được thay đổi', [], 404);
        }
        return MyHelper::response(true, 'Successfully', $result, 200);
    }
    public function findVariantByCategoryId ($req) {
        $all = $req->all();
        if(empty($all) || is_null($all)){
            return MyHelper::response(false, 'Không lấy được dữ liệu thuộc tính', [], 404);
        }
        $cat_id = $all['id'];
        $arr_var_id = VariantCategory::where('cat_id' , $cat_id )->orderBy('var_id')->get();
        $result = [];
        if(empty($arr_var_id)){
            return MyHelper::response(true, 'Successfully', $result, 200);
        }
        foreach($arr_var_id as $val){
            $variant = Variant::query()->select(
                'var_id',
                        'vg_id',
                        'var_name',
                        'var_code',
                        'var_type',
                        'var_unit',
                        'var_order',
                        'var_require',
                        'var_searchable'
            )->where('var_id' , $val->var_id)->with('variantValues')->first();
            if($variant){
                array_push($result , $variant->toArray());
            }
        }
        if(empty($result)){
            return MyHelper::response(true, 'Successfully', $result, 200);
        }
        $result = array_filter( $result , function( $value ){
            return !empty( $value );
        } );
        return MyHelper::response(true, 'Successfully', $result, 200);
    }

    public function createNewVariant ($request) {
        $validated = $request->validated();
        $user      = JWTAuth::parseToken()->authenticate();
        $validated['var_require'] = filter_var($validated['var_require'], FILTER_VALIDATE_BOOLEAN) ?"Y":"N";
        $validated['var_searchable'] =  filter_var($validated['var_searchable'], FILTER_VALIDATE_BOOLEAN) ?"Y":"N";
        try{
            DB::beginTransaction();
            $id = Variant::insertGetId( [
                'vg_id' => $validated[ 'vg_id' ],
                'var_parent_id' => $validated[ 'var_parent_id' ],
                'var_name' => $validated[ 'var_name' ] ,
                'var_code' => $validated[ 'var_code' ] ,
                'var_type' => $validated[ 'var_type' ] ,
                'var_unit' => $validated[ 'var_unit' ] ,
                'var_order' => $validated[ 'var_order' ] ,
                'var_description' => $validated[ 'var_description' ] ,
                'var_require' => $validated[ 'var_require' ] ,
                'var_searchable' => $validated[ 'var_searchable' ] ,
                'user_id' => $user->user_id ,
                'groupid' => $user->groupid ,
                'created_at' => time() ,
                'updated_at' => time() ,
            ] );
            if( !empty( $validated[ 'cat_id' ] ) ){
                $validated[ 'cat_id' ] = explode(",", $validated[ 'cat_id' ]);
                $filteredArr = removeNullValueFromArray($validated[ 'cat_id' ]);
                if( !empty( $filteredArr ) && count( $filteredArr ) > 0 ){
                    $this->createVariantCategory( $filteredArr , $id );
                }
            }
            DB::commit();
            return MyHelper::response( true , 'Tạo mới thành công id : '.$id , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function updateVariant( $request ){
        $validated = $request->validated();
        $user      = JWTAuth::parseToken()->authenticate();
        $validated['var_require'] = filter_var($validated['var_require'], FILTER_VALIDATE_BOOLEAN) ?"Y":"N";
        $validated['var_searchable'] =  filter_var($validated['var_searchable'], FILTER_VALIDATE_BOOLEAN) ?"Y":"N";
        try{
            DB::beginTransaction();
            $model = ( new Variant() )->getById( $validated[ 'var_id' ] );
            if( !$model ){
                return MyHelper::response( false , 'Không thể cập nhật dữ liệu' , [] , 500 );
            }
            $model->update( [
                'vg_id' => $validated[ 'vg_id' ],
                'var_parent_id' => $validated[ 'var_parent_id' ],
                'var_name' => $validated[ 'var_name' ] ,
                'var_code' => $validated[ 'var_code' ] ,
                'var_type' => $validated[ 'var_type' ] ,
                'var_unit' => $validated[ 'var_unit' ] ,
                'var_order' => $validated[ 'var_order' ] ,
                'var_description' => $validated[ 'var_description' ] ,
                'var_require' => $validated[ 'var_require' ] ,
                'var_searchable' => $validated[ 'var_searchable' ] ,
                'updated_at' => time() ,
            ] );
            if( !empty( $validated[ 'cat_id' ] )  ){
                 $validated[ 'cat_id' ] = explode(",", $validated[ 'cat_id' ]);
                $filteredArr = removeNullValueFromArray( $validated[ 'cat_id' ]);
            }else{
                $filteredArr = [];
            }
            $this->updateVariantCategory( $filteredArr , $validated[ 'var_id' ] );
            DB::commit();
            return MyHelper::response( true , 'Cập nhật thành công id : '.$validated[ 'vg_id' ]  , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }
    public function getVariant ($id) {
        return ( new Variant() )->getById($id);
    }
    public function deleteVariant( $req ){
        $validator = Validator::make( $req->all() , [
            'id' => 'required|integer' ,
        ] );
        if( $validator->fails() ){
            return MyHelper::response( false , 'Kiểm tra lại định dạng dữ liệu' , [] , 404 );
        }
        $req     = $req->all();
        $variant = ( new Variant() )->findFirstById( $req[ 'id' ] );
        if( !$variant ){
            return MyHelper::response( false , 'Không tìm thấy dữ liệu' , [] , 404 );
        }
        $deleted = $variant->delete();
        if( $deleted ){
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }else{
            return MyHelper::response( false , 'Không thành công' , [] , 404 );
        }
    }

    //Variant category
    public function createVariantCategory ($arr_cat_id, $var_id) {
        foreach($arr_cat_id as $value){
            $input = [
                'cat_id' => $value, 'var_id' => $var_id,
            ];
            ( new VariantCategory() )->createnew($input);
        }
    }
    public function updateVariantCategory ($arr_cat_id, $var_id) {
        VariantCategory::where('var_id', $var_id)->delete();
            if( !empty( $arr_cat_id ) && count( $arr_cat_id ) > 0 ){
            foreach($arr_cat_id as $value){
                $input = [
                    'cat_id' => $value,
                    'var_id' => $var_id,
                ];
                ( new VariantCategory() )->createnew($input);
            }
        }
    }
}
