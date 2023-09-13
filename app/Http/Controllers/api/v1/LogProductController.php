<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Functions\MyHelper;
use App\Models\LogProduct;
use App\Traits\LogProductTraits;
use Illuminate\Http\Request;

class LogProductController extends Controller
{
    use LogProductTraits;
    public function getAll(Request $request){
        return $this->getAllLog($request);
    }
    public function viewLog(Request $request){
        $request = $request->all();
        if(!array_key_exists("log_prd_id" , $request) && !is_numeric($request['log_prd_id'])){
            return MyHelper::response(false, 'Kiểm tra lại định dạng dữ liệu', [], 404);
        }
        $log = LogProduct::select('log_prd_id' , 'w_id','log_prd_old_value','log_prd_new_value')->where('log_prd_id' , $request['log_prd_id'])->first();
        if($log){
            return MyHelper::response(true, 'Success', $log, 200);
        }
        return MyHelper::response(false, 'Không tìm thấy dữ liệu hợp lệ', [], 404);
    }
}
