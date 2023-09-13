<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PositionCategoryModel;
use App\Http\Functions\MyHelper;
use JWTAuth;
use App\Models\Warehouse;
use DB;

class PositionCategoryController extends Controller
{
    public function index (Request $request) {
        $keyword = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $query = PositionCategoryModel::query();
        $all_search = $request->all();
        $user = JWTAuth::parseToken()->authenticate();

        // if (!empty($keyword)) {
        //     $query->where('name', 'LIKE', "%$keyword%");
        // }

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
        $position = $query->orderByRaw('level asc,id desc')->paginate($perPage);
        if (!$position) {
            return MyHelper::response(false, 'No data found', [], 404);
        }

        foreach ($position as $val) {
            $val['created_at'] = strtotime($val['created_at']);
            $check_ware = Warehouse::where('w_id',$val->warehouse_id)->first();
            if($check_ware){
                $val['warehouse_name'] = $check_ware->w_name;
            }else{
                $val['warehouse_name'] = null;
            }
            $select=[
                'id',
                'name',
                'parent',
                'parent2',
                'level',
                'warehouse_id',
                'created_by',
                'created_at',
            ];
            
                $name = $val->name;
                if($val->level == 3) {
                    $parent_level2 = PositionCategoryModel::where('id', $val->parent)->first();
                    $parent_level1  = PositionCategoryModel::where('id', $parent_level2->parent)->first();
                    $level2_name = $parent_level2->name ?? '';
                    $level1_name = $parent_level1->name ?? '';
                    $val['cate_positon'] = $level1_name.'/'.$level2_name.'/'.$name;
                 }else if ($val->level == 2) {
                    $parent_level1  = PositionCategoryModel::where('id', $val->parent)->first();
                    $level1_name = $parent_level1->name ?? '';
                    $val['cate_positon'] = $level1_name.'/'.$name;
                 }else if ($val->level == 1){
                    $val['cate_positon'] = $name;
                 }
             
            $childrents=PositionCategoryModel::where('parent',$val['id'])->orderBy('id', 'asc')->select($select)->get();
            if(isset($childrents)){
                $val['child']=$childrents;
                foreach($childrents as $val){
                    $check_ware = Warehouse::where('w_id',$val->warehouse_id)->first();
                    if($check_ware){
                        $val['warehouse_name'] = $check_ware->w_name;
                    }else{
                        $val['warehouse_name'] = null;
                    }
                    $childrents2=PositionCategoryModel::where('parent',$val['id'])->orderBy('id', 'asc')->select($select)->get();
                    if(isset($childrents2)) {
                        foreach($childrents as $val){
                            $check_ware = Warehouse::where('w_id',$val->warehouse_id)->first();
                            if($check_ware){
                                $val['warehouse_name'] = $check_ware->w_name;
                            }else{
                                $val['warehouse_name'] = null;
                            }
                        }
                    }
                    $val['childs']=$childrents2;
                }
            }else{
                $val['childs']=[];
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
        $groupid = $user->groupid;
        $creby = $user->user_id;
        $time = time();
        $name = $request->name;
        $level = $request->level;
        $parent = $request->parent;
        $ware_house = $request->warehouse_id ?? 0;
        $check_ware = Warehouse::where('w_id',$ware_house)->first();
        if(!$check_ware) {
            return MyHelper::response(false, 'ware house not found', [], 404);
        }
        if ($level == 1 || $level == "1") {
            $parent = 0;
        }
        if ($parent !== 0) {
            $checkparent = (new PositionCategoryModel)->checkExist($parent,$ware_house);
            if (!$checkparent) {
                return MyHelper::response(false, 'position category not found', [], 404);
            }
        }
        if (isset($level)) {
            if ($level == 2) {
                $parent = $request->parent;
                $TicketCheck = PositionCategoryModel::where('id', $parent)->first();
                if (!$TicketCheck) {

                    return MyHelper::response(false, 'Category ' . $parent . ' not found', [], 404);
                }
                if ($TicketCheck->level == 3) {

                    return MyHelper::response(false, 'Category ' . $parent . ' level 3 cannot be parent of level 2', [], 403);
                } elseif ($TicketCheck->level == 2) {

                    return MyHelper::response(false, 'Category ' . $parent . ' level 2 can not be parent of each others', [], 401);
                }
                $parent2 = $parent;
            } elseif ($level == 3) {
                $parent = $request->parent;
                $TicketCheck = PositionCategoryModel::where('id', $parent)->first();
                if (!$TicketCheck) {

                    return MyHelper::response(false, 'Category ' . $parent . ' not found', [], 404);
                }
                if ($TicketCheck->level == 1) {

                    return MyHelper::response(false, 'Category ' . $parent . ' level 1 cannot be parent of level 3', [], 404);
                } elseif ($TicketCheck->level == 3) {

                    return MyHelper::response(false, 'Category ' . $parent . ' level 3 can not be parent of each others', [], 401);
                }
                $parent2 = $TicketCheck->parent . ',' . $parent;
            }
        }
        DB::beginTransaction();
        try {
            DB::commit();
            $order = new PositionCategoryModel;
            $order->groupid = $groupid;
            $order->name = $name;
            $order->level = $level;
            $order->parent = $parent;
            $order->warehouse_id = $ware_house;
            $order->created_by = $creby;
            $order->created_at = $time;
            $order->save();
            if ($level == 2 || $level == 3) {
                $category = $order->showOne($order->id);
                $category->parent2 = $parent2 . ',' . $category->id;
                $category->save();
            }
            if ($level == 1) {
                $category = $order->showOne($order->id);
                $category->parent2 = $order->id;
                $category->save();
            }
            return MyHelper::response(true, 'Created postion category successfully', ['id' => $order->id], 200);
        } catch (\Exception $ex) {
            DB::rollback();
            return MyHelper::response(false, $ex->getMessage(), [], 403);
        }
    }

    public function delete($id)
    {
        $TicketCategory = (new PositionCategoryModel)->checkExist($id);
        if (!$TicketCategory) {
            return MyHelper::response(false, 'TicketCategory Not Found', [], 404);
        } else {
            $level = $TicketCategory->level;
            $parent = $TicketCategory->parent;
            if ($level == 2) {
                $TicketCategory->delete();
                $value = PositionCategoryModel::where('parent', $parent)->where('level', 2)->get()->pluck('id')->toArray();
                $parents = implode(',', $value);
                $categoryChange = PositionCategoryModel::where('parent', $parent)->where('level', 3)->update(['parent2' => $parents]);
            } else {
                $TicketCategory->delete();
            }
        }
        return MyHelper::response(true, 'Delete TicketCategory Successfully', [], 200);
    }

    public function LevelSearch(Request $request)
    {
        $level = $request->level ?? 0;
        $ware = $request->warehouse ?? 0;
        $value = PositionCategoryModel::where('level', $level)->where('warehouse_id',$ware)->get();
        return MyHelper::response(true, 'Successfully', $value, 200);
    }

    public function ParentSearch (Request $request) {
        $parent = $request->parent ?? 0;
        $value = PositionCategoryModel::where('parent', $parent)->get();
        return MyHelper::response(true, 'Successfully', $value, 200);
    }
}
