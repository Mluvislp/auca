<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Imports\CategoryImport;
use App\Models\Category;
use Auth;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Maatwebsite\Excel\Facades\Excel;

trait CategoryTrait {
    use CategoryTagTrait;

    public function listAllCategory ($request) {
        $listAllCategory = $this->queryAll($request);
        if($listAllCategory === false){
            return MyHelper::response(false, 'No data found', [], 404);
        }
        $totalCategories = $listAllCategory->count();
        $data            = [ 'data' => $listAllCategory, 'total' => $totalCategories,
        ];
        return MyHelper::response(true, 'Successfully', $data, 200);
    }

    public function queryAll ($request) {
        $all_search = $request->all();
        $query      = Category::query();
        $sort       = true;
        if(array_key_exists('filter_cat_code', $all_search) && $all_search[ 'filter_cat_code' ]){
            $query->where('cat_code', 'LIKE', '%' . $all_search[ 'filter_cat_code' ] . '%');
            $sort = false;
        }
        if(array_key_exists('filter_cat_name', $all_search) && $all_search[ 'filter_cat_name' ]){
            $query->where('cat_name', 'LIKE', '%' . $all_search[ 'filter_cat_name' ] . '%');
            $sort = false;
        }
        $categories = $query->with('user')->withCount('categoryProduct')->orderBy('created_at', "DESC")->get();
        if($sort){
            $sortedCategories = $this->sortCategories($categories);
            if($sortedCategories->isEmpty()){
                return false;
            }
        }
        else{
            $sortedCategories = $categories;
        }
        return $sortedCategories;
    }

    public function sortCategories ($categories, $parentId = null, $level = 0) {
        $sortedCategories = collect();
        foreach($categories as $category){
            if($category->cat_parent_id == $parentId){
                $category->cat_name = str_repeat(' - ', $level) . $category->cat_name;
                $sortedCategories->push($category);
                $children         = $this->sortCategories($categories, $category->cat_id, $level + 1);
                $sortedCategories = $sortedCategories->concat($children);
            }
        }
        return $sortedCategories;
    }

    public function updateOrderCategoryById ($req) {
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
            $model = ( new Category() )->findFirstById($key);
            if(!$model){
                $result[ $key ] = [ 'status' => false,
                ];
            }
            else{
                if((int)$val < 0){
                    $result[ $key ] = [
                        'status' => false ,
                    ];
                }else{
                    if($model[ 'cat_order' ] !== $val){
                        $update = $model->update([ 'cat_order' => $val ]);
                        if(!$update){
                            $result[ $key ] = [ 'status' => false,
                            ];
                        }
                        else{
                            $result[ $key ] = [ 'status' => true,
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

    public function createCategory ($req) {
        $validated = $req->validated();
        $user      = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $file_cat_image      = $req->file('cat_image');
            $file_cat_icon       = $req->file('cat_icon');
            $name_file_cat_image = '';
            $name_file_cat_icon  = '';
            if(!is_null($file_cat_image)){
                $upload_cat_image = checkIsImageAndUpLoad($file_cat_image);
                if(!$upload_cat_image){
                    return MyHelper::response(false, 'Vui lòng tải lên file đúng định dạng', [], 500);
                }
                $name_file_cat_image = $upload_cat_image;
            }
            if(!is_null($file_cat_icon)){
                $upload_cat_icon = checkIsImageAndUpLoad($file_cat_icon);
                if(!$upload_cat_icon){
                    return MyHelper::response(false, 'Vui lòng tải lên file đúng định dạng', [], 500);
                }
                $name_file_cat_icon = $upload_cat_icon;
            }
            $new_id = Category::insertGetId([ 'cat_name'        => $validated[ 'cat_name' ],
                                              'cat_code'        => $validated[ 'cat_code' ],
                                              'cat_parent_id'   => $validated[ 'cat_parent_id' ],
                                              'cat_order'       => $validated[ 'cat_order' ],
                                              'cat_description' => $validated[ 'cat_description' ],
                                              'cat_status'      => $validated[ 'cat_status' ],
                                              'cat_image'       => $name_file_cat_image,
                                              'cat_icon'        => $name_file_cat_icon,
                                              'groupid'         => $user->groupid,
                                              'user_id'         => $user->user_id,
                                              'created_at'      => time(),
                                              'updated_at'      => time(),
            ]);
            if($new_id){
                if(!empty($validated[ 'cat_tag' ])){
                    $validated[ 'cat_tag' ] = explode(",", $validated[ 'cat_tag' ]);
                    $filteredArr            = removeNullValueFromArray($validated[ 'cat_tag' ]);
                    if(!empty($filteredArr) && count($filteredArr) > 0){
                        $this->createCategoryTag($filteredArr, $new_id);
                    }
                }
            }
            DB::commit();
            return MyHelper::response(true, 'Tạo mới thành công id : ' . $new_id, [], 200);
        }catch(\Exception $ex){
            DB::rollback();
            return MyHelper::response(false, 'Tạo mới thất bại', [], 500);
        }
    }

    public function updateCategoryById ($req) {
        $validated = $req->validated();
        $user      = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $model = $this->getCategory($validated[ 'cat_id' ]);
            if(!$model){
                return MyHelper::response(false, 'Không thể cập nhật dữ liệu', [], 500);
            }
            $file_cat_image      = $req->file('cat_image');
            $file_cat_icon       = $req->file('cat_icon');
            $name_file_cat_image = '';
            $name_file_cat_icon  = '';
            if(!is_null($file_cat_image)){
                $upload_cat_image = checkIsImageAndUpLoad($file_cat_image);
                if(!$upload_cat_image){
                    return MyHelper::response(false, 'Vui lòng tải lên file đúng định dạng', [], 500);
                }
                $name_file_cat_image = $upload_cat_image;
            }
            if(!is_null($file_cat_icon)){
                $upload_cat_icon = checkIsImageAndUpLoad($file_cat_icon);
                if(!$upload_cat_icon){
                    return MyHelper::response(false, 'Vui lòng tải lên file đúng định dạng', [], 500);
                }
                $name_file_cat_icon = $upload_cat_icon;
            }
            $model->update([ 'cat_name'        => $validated[ 'cat_name' ],
                             'cat_code'        => $validated[ 'cat_code' ],
                             'cat_parent_id'   => $validated[ 'cat_parent_id' ],
                             'cat_order'       => $validated[ 'cat_order' ],
                             'cat_description' => $validated[ 'cat_description' ],
                             'cat_status'      => $validated[ 'cat_status' ],
                             'cat_image'       => !empty($name_file_cat_image) ? $name_file_cat_image : $model->cat_image,
                             'cat_icon'        => !empty($name_file_cat_icon) ? $name_file_cat_icon : $model->cat_icon,
                             'updated_at'      => time(),
            ]);
            $this->deleteByCatId($validated[ 'cat_id' ]);
            if(!empty($validated[ 'cat_tag' ])){
                $validated[ 'cat_tag' ] = explode(",", $validated[ 'cat_tag' ]);
                $filteredArr            = removeNullValueFromArray($validated[ 'cat_tag' ]);
                if(!empty($filteredArr) && count($filteredArr) > 0){
                    $this->createCategoryTag($filteredArr, $validated[ 'cat_id' ]);
                }
            }
            DB::commit();
            return MyHelper::response(true, 'Cập nhật thành công id : ' . $validated[ 'cat_id' ], [], 200);
        }catch(\Exception $ex){
            dd($ex);
            DB::rollback();
            return MyHelper::response(false, 'Cập nhật thất bại', [], 500);
        }
    }

    public function handleImportCategory ($req) {
        try{
            $import = new CategoryImport();
            Excel::import($import, $req->file('fileUpload'));
            $total     = $import->getTotal();
            $failures  = $import->getFailures();
            $successes = $import->getSuccesses();
            $fail_data = [];
            if(!empty($failures)){
                foreach($failures as $failure){
                    $rowIndex    = $failure[ 'row_index' ];
                    $errors      = $failure[ 'errors' ];
                    $fail_data[] = [ 'row_index' => $rowIndex, 'errors' => $errors,
                    ];
                }
            }
            $import_response_data = [ 'success_count' => $successes, 'fail_data' => $fail_data,
                                      'total_record'  => $total,
            ];
            if($successes > 0){
                return MyHelper::response(true, "Thêm mới liệu thành công", $import_response_data, 200);
            }
            else{
                return MyHelper::response(false, 'Đã có lỗi xảy ra trong quá trình thêm dữ liệu', $import_response_data, 404);
            }
        }catch(\Exception $e){
            return MyHelper::response(false, 'Đã có lỗi xảy ra trong quá trình thêm dữ liệu', [], 404);
        }
    }

    public function getIdAndNameCategoryForCombo ($id = false) {
        $categories = ( new Category() )->getIdAndNameForCombo($id);
        if(!$categories){
            return false;
        }
        return $categories;
    }

    public function getCategory ($id) {
        return ( new Category() )->findFirstById($id);
    }

    public function deleteCategory ($req) {
        try{
            $validator = Validator::make($req->all(), [ 'id' => 'required|integer',
            ]);
            if($validator->fails()){
                return MyHelper::response(false, 'Kiểm tra lại định dạng dữ liệu', [], 404);
            }
            $req   = $req->all();
            $model = ( new Category() )->findFirstById($req[ 'id' ]);
            if(!$model){
                return MyHelper::response(false, 'Không tìm thấy dữ liệu', [], 404);
            }
            $deleted = $model->delete();
            if($deleted){
                return MyHelper::response(true, 'Xoá thành công id : ' . $req[ 'id' ], [], 200);
            }
            else{
                return MyHelper::response(false, 'Không thành công', [], 404);
            }
        }catch(\Exception $e){
            return MyHelper::response(false, 'Không thể xoá danh mục: ' . $e->getMessage(), [], 404);
        }
    }
}
