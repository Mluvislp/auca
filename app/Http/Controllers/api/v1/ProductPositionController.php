<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductPositionModel;
use App\Http\Functions\MyHelper;
use JWTAuth;
use App\Models\Product;
use App\Models\PositionCategoryModel;
use DB;
class ProductPositionController extends Controller
{
    public function index (Request $request) {
        $keyword = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $query = ProductPositionModel::query();
        $all_search = $request->all();
        $user = JWTAuth::parseToken()->authenticate();

        if (!empty($keyword)) {
            $query->where('position_value', 'LIKE', "%$keyword%");
        }

        if (array_key_exists('columns', $all_search)) {
            foreach ($all_search['columns'] as $val) {
                if (!isset($val['search']['value']) || is_null($val['search']['value']) || !$val['searchable']) {
                    continue;
                } else {
                    if ($val['name'] == 'prd_name') {
                        $product = Product::where('prd_name','like','%' . $val['search']['value'] . '%',)->first();
                        if($product) {
                            $prd_id = $product->prd_id ;
                        }else{
                            $prd_id = 0 ;
                        }
                        $query->where('prd_id',$prd_id);
                    }else{
                        $operator = ($val['name'] == $val['name'] ? '=' : 'LIKE');
                        $percent_percent = ($val['name'] == $val['name'] ? "" : "%");
                        $query->where($val['name'], $operator, $percent_percent . $val['search']['value'] . $percent_percent);
                    }
                    
                }
            }
        }
        if ($request->has('id')) {
            $query->where('id', '=', $request->input('id'));
        }
        $position = $query->orderByRaw('id desc')->paginate($perPage);
        if (!$position) {
            return MyHelper::response(false, 'No data found', [], 404);
        }

        foreach ($position as $val) {
           $product = Product::where('prd_id',$val['prd_id'])->first();
           $val['prd_name'] = $product->prd_name ;
           $val['prd_code'] = $product->prd_code ;
           $val['cate_positon'] = '' ;
           if($val['category_id'] !== 0) {
             $category = PositionCategoryModel::where('id', $val['category_id'])->first();

             if($category) {
                $name = $category->name;
                if($category->level == 3) {
                    $parent_level2 = $category = PositionCategoryModel::where('id', $category->parent)->first();
                    $parent_level1 = $category = PositionCategoryModel::where('id', $parent_level2->parent)->first();
                    $level2_name = $parent_level2->name ?? '';
                    $level1_name = $parent_level1->name ?? '';
                    $val['cate_positon'] = $level1_name.'/'.$level2_name.'/'.$name;
                 }else if ($category->level == 2) {
                    $parent_level1 = $category = PositionCategoryModel::where('id', $category->parent)->first();
                    $level1_name = $parent_level1->name ?? '';
                    $val['cate_positon'] = $level1_name.'/'.$name;
                 }else if ($category->level == 1){
                    $val['cate_positon'] = $name;
                 }
             }
           }
        }

        $data = [
            'data' => collect($position->items())->map(function ($positions) {
                return $positions;
            }),
            'total' => $position->total(),
            'per_page' => $position->perPage(),
            'current_page' => $position->currentPage(),
        ];

        return MyHelper::response(true, 'Successfully', $data, 200);
    }

    public function create (Request $request) 
    {
        $user = JWTAuth::parseToken()->authenticate();
        $req  = $request->all();

        $value    = $request->position_value ?? 'undefined';
        $prd_id        = $request->prd_id ?? 0;
        $warehouse_id         = $request->warehouse_id ?? 1;
        $type         = $request->type ?? 1;
        $quantity         = $request->quantity ?? 1;
        $category         = $request->category?? 0;
        $product = Product::where( 'prd_id' , $prd_id )->first();
        if(!$product) {
            return MyHelper::response(true, 'Product not found',[], 200);
        }
        DB::beginTransaction();
        try{
            DB::commit();
            $position                   = new ProductPositionModel;
            $position->groupid    = $user->groupid;
            $position->position_value    = $value;
            $position->prd_id         = $prd_id;
            $position->warehouse_id         = $warehouse_id;
            $position->postion_type          = $type ;
            $position->datecreated        = time();
            $position->created_by         = $user->user_id;
            $position->quantity           = $quantity;
            $position->category_id           = $category;
            $position->save();
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function delete (Request $request,$id) 
    {
        $position =  ProductPositionModel::where('id',$id)->first();
        if(!$position) {
            return MyHelper::response(true, 'Position not found',[], 200);
        }
        $position->delete();
        return MyHelper::response( true , 'Successfully' , [] , 200 );
    }
}
