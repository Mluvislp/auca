<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Functions\MyHelper;
use App\Models\BatchProductModel;
use App\Models\BatchModel;
use Illuminate\Http\Request;
use App\Models\Product;
use JWTAuth;

use DB;
class BatchProductController extends Controller
{
    public function showAll(Request $request)
    {
        $keyword = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $query = BatchProductModel::query();
        $all_search = $request->all();
        $user = JWTAuth::parseToken()->authenticate();
        if (!empty($keyword)) {
            $query->where('bp_name', 'LIKE', "%$keyword%");
        }
        if (array_key_exists('columns', $all_search)) {

            foreach ($all_search['columns'] as $val) {
                if (!isset($val['search']['value']) || is_null($val['search']['value']) || !$val['searchable']) {
                    continue;
                } else {
                    if($val['name'] == 'bp_manufacture_date' || $val['name'] == 'bp_expired_date'){
                        $startDate = isset($val['search']['value']) ? strtotime($val['search']['value']) : time();
                        $endDate = isset($val['search']['value2']) ? strtotime($val['search']['value2']) : time();
                        $query->whereBetween($val['name'],[$startDate,$endDate]);
                    }else{
                        $operator = ($val['name'] == $val['name'] ? '=' : 'LIKE');
                        $percent_percent = ($val['name'] == $val['name'] ? "" : "%");
                        $query->where($val['name'], $operator, $percent_percent . $val['search']['value'] . $percent_percent);
                    }
                }
            }
        }
        if ($request->has('bp_id')) {
            $query->where('bp_id', '=', $request->input('bp_id'));
        }
        $batch = $query->orderByRaw('bp_id desc')->paginate($perPage);
        if (!$batch) {
            return MyHelper::response(false, 'No data found', [], 404);
        }
        foreach ($batch as $val) {
            $currentDateTimestamp = time();
// Ngày được chỉ định (trong ví dụ này, tôi lấy một ngày cụ thể là 2023-07-31)
            $specifiedDate = $val['bp_manufacture_date'];
            $specifiedDateTimestamp = $val['bp_expired_date'];
// Tính số giây chênh lệch giữa ngày hiện tại và ngày được chỉ định
            $timeDifferenceInSeconds = $specifiedDateTimestamp - $currentDateTimestamp;
// Chuyển số giây sang số ngày
           $val['date_left'] = floor($timeDifferenceInSeconds / (60 * 60 * 24));
           $proDuct = Product::where('groupid',$user->groupid)->where('prd_id',$val['prd_id'])->first();
           $val['prd_name'] = $proDuct->prd_name ?? 'Not availible';
            $val['status_data'] = [
                'id' => $val['bp_id'],
                'status' => $val['bp_status'],
            ];
            $val['bp_manufacture_date'] = date('Y-m-d H:i:s', $val['bp_manufacture_date']);
            $val['bp_expired_date'] = date('Y-m-d H:i:s', $val['bp_expired_date']);
        }
        $data = [
            'data' => collect($batch->items())->map(function ($batch2) {
                return $batch2;
            }),
            'total' => $batch->total(),
            'per_page' => $batch->perPage(),
            'current_page' => $batch->currentPage(),
        ];

        return MyHelper::response(true, 'Successfully', $data, 200);
    }

    public function show($id)
    {
        $batch = BatchProductModel::where('bp_id', $id)->first();
        if (!$batch) {
            return MyHelper::response(false, 'not found', [], 404);
        } else {
            if(isset($batch->bp_manufacture_date)){
                $batch->bp_manufacture_date = date('Y-m-d H:i:s', $batch->bp_manufacture_date);
            }
            if(isset($batch->bp_expired_date)){
                $specifiedDateTimestamp = $batch->bp_expired_date ;
                $batch->bp_expired_date = date('Y-m-d H:i:s', $batch->bp_expired_date);
                $currentDateTimestamp = time();
                $timeDifferenceInSeconds = $specifiedDateTimestamp - $currentDateTimestamp;
    
                $batch->date_left = floor($timeDifferenceInSeconds / (60 * 60 * 24));
            }else{
                $batch->date_left = 0 ;
            }
            $proDuct = Product::where('prd_id',$batch->prd_id)->first();
            $batch->prd_name = $proDuct->prd_name ?? 'Not availible';

            return MyHelper::response(true, 'Successfully', $batch, 200);
        }
    }


    public function create(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $req  = $request->all();
        DB::beginTransaction();
        try{
            DB::commit();
            $bp_name    = $request->bp_name ?? 'undefined';
            $bp_price        = $request->bp_price ?? '';
            $bp_status         = $request->bp_status ?? 1;
            $batch_id         = $request->batch_id ?? 0;
            $prd_id         = $request->prd_id ?? 0;
            $bp_manufacture_date        = strtotime($request->bp_manufacture_date) ?? 0;
            $bp_expired_date              = strtotime($request->bp_expired_date) ?? 0;
            if( !isset($bp_manufacture_date)){
                $bp_manufacture_date = time();
            }
            if(!isset($bp_expired_date)){
                $bp_expired_date = time();
            }
            $batch                   = new BatchProductModel;
            $batch->bp_name    = $bp_name;
            $batch->bp_price         = $bp_price;
            $batch->bp_status         = $bp_status;
            $batch->prd_id          = $prd_id ;
            $batch->batch_id        = $batch_id;
            $batch->bp_manufacture_date         = $bp_manufacture_date;
            $batch->bp_expired_date          = $bp_expired_date ;
            $batch->groupid = $user->groupid;
            $batch->save();
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function createBatch(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $req  = $request->all();
        DB::beginTransaction();
        try{
            DB::commit();
            $bp_name    = $request->bp_name ?? 'undefined';
            $bp_status         = $request->bp_status ?? 1;
            $batch                   = new BatchModel;
            $batch->batch_name    = $bp_name;
            $batch->batch_status         = $bp_status;
            $batch->groupid = $user->groupid;
            $batch->user_id         = $user->user_id;
            $batch->created_at         = time();
            $batch->updated_at         = 0;
            $batch->save();
            return MyHelper::response( true , 'Successfully' , ['id' => $batch->batch_id] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }


    public function importBatch(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $req  = $request->all();
        $bp_name    = $request->bp_name ?? 'undefined';
        $bp_price        = $request->bp_price ?? '';
        $bp_status         = $request->bp_status ?? 1;
        $prd_id         = $request->prd_id ?? 0;
        $product  = Product::where('groupid',$user->groupid)->where('prd_id',$prd_id)->first();
        if (!$product) {
            return MyHelper::response( false , 'Not found' , ['id' => $prd_id] , 404 );
        }
        if($product->prd_type_id != 8) {
            return MyHelper::response( false , 'Not found' , ['id' => $prd_id] , 405 );
        }
        $batch                   = new BatchModel;
        $batch->batch_name    = $bp_name;
        $batch->batch_status         = $bp_status;
        $batch->groupid = $user->groupid;
        $batch->user_id         = $user->user_id;
        $batch->created_at         = time();
        $batch->updated_at         = 0;
        $batch->save();
        DB::beginTransaction();
        try{
            DB::commit();
            $bp_manufacture_date        = strtotime($request->bp_manufacture_date) ?? 0;
            $bp_expired_date              = strtotime($request->bp_expired_date) ?? 0;
            if( !isset($bp_manufacture_date)){
                $bp_manufacture_date = time();
            }
            if(!isset($bp_expired_date)){
                $bp_expired_date = time();
            }
            $batch_prd                   = new BatchProductModel;
            $batch_prd->bp_name    = $bp_name;
            $batch_prd->bp_price         = $bp_price;
            $batch_prd->bp_status         = $bp_status;
            $batch_prd->prd_id          = $prd_id ;
            $batch_prd->batch_id        = $batch->batch_id;
            $batch_prd->bp_manufacture_date         = $bp_manufacture_date;
            $batch_prd->bp_expired_date          = $bp_expired_date ;
            $batch_prd->groupid = $user->groupid;
            $batch_prd->save();
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }


    public function update(Request $request,$id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $batchVal           = BatchProductModel::where( 'bp_id' , $id )->first();
        if (!$batchVal) {
            return MyHelper::response(false, 'not found', [], 404);
        }
        $req  = $request->all();
        DB::beginTransaction();
        try{
            DB::commit();
            $batch                   = BatchProductModel::where( 'bp_id' , $id )->first();
            $batch->bp_name    =  isset( $request->bp_name ) ? $request->bp_name : $batchVal->bp_name;
            $batch->bp_price         =  isset( $request->bp_price ) ? $request->bp_price : $batchVal->bp_price;
            $batch->bp_status         = isset( $request->bp_status ) ? $request->bp_status : $batchVal->bp_status;
            $batch->bp_manufacture_date         =  isset( $request->bp_manufacture_date ) ? strtotime($request->bp_manufacture_date) : $batchVal->bp_manufacture_date;
            $batch->bp_expired_date          =  isset( $request->bp_expired_date ) ? strtotime($request->bp_expired_date) : $batchVal->bp_expired_date;
            $batch->save();
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function delete($id)
    {
        $batch = BatchProductModel::where('bp_id', $id)->first();
        if (!$batch) {
            return MyHelper::response(false, 'not found', [], 404);
        } else {
            $batch->delete();
            return MyHelper::response(true, 'Successfully', [], 200);
        }
    }
    public function updateStatus ($id) {
        $batch = BatchProductModel::where( 'bp_id' , $id )->first();
        if( !$batch ){
            return MyHelper::response( false , 'Not found' , [] , 404 );
        }else{

            DB::beginTransaction();
            try{
                DB::commit();
                if( $batch->bp_status == 1 || $batch->bp_status == '1' ){
                    $batch->bp_status = 2;
                    $batch->save();
                }else{
                    $batch->bp_status = 1;
                    $batch->save();
                }
                $batch->save();
            }catch( \Exception $ex ){
                DB::rollback();
                return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
            }

            return MyHelper::response( true , 'Successfully' , [ $batch ] , 200 );
        }
    }
}
