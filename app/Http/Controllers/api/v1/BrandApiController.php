<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Functions\MyHelper;
use App\Http\Requests\Brand\BrandRequest;
use App\Models\BrandModel;
use App\Traits\BrandTrait;
use DB;
use Illuminate\Http\Request;

class BrandApiController extends Controller
{
    use BrandTrait;

    public function GetAllbrand(Request $request)
    {
        return $this->GetAll($request);
    }

    public function show($id)
    {
        $brandval = BrandModel::where('brand_id', $id)->first();
        if (!$brandval) {
            return MyHelper::response(false, 'not found', [], 404);
        } else {
            if (isset($brandval->brand_image)) {
                $brandval->brand_image_name = $brandval->brand_image;
                $brandval->brand_image = asset('/storage/' . $brandval->brand_image);
            }
            return MyHelper::response(true, 'Successfully', $brandval, 200);
        }
    }

    public function updateStatus($id)
    {
        return $this->updatestatusFunc($id);
    }

    public function updateOrder($id, Request $request)
    {
        $brand = BrandModel::where('brand_id', $id)->first();
        $req = $request->all();

        if (!$brand) {
            return MyHelper::response(false, 'Not found', [], 404);
        } else {
            $count = $req['count'] ?? $brand->brand_order;
            DB::beginTransaction();
            try {
                DB::commit();
                $checkOrder = BrandModel::where('brand_order', $count)->first();
                if ($checkOrder) {
                    $checkOrder->brand_order = $brand->brand_order;
                    $checkOrder->save();
                }
                $brand->brand_order = $count;
                $brand->save();
            } catch (\Exception $ex) {
                DB::rollback();
                return MyHelper::response(false, $ex->getMessage() . 'at line' . $ex->getLine(), [], 500);
            }

            return MyHelper::response(true, 'Successfully', [$brand], 200);
        }
    }

    public function store(BrandRequest $request)
    {
        return $this->Created($request);
    }

    public function update(Request $request, $id)
    {
        return $this->updateContent($request, $id);
    }

    public function destroy($id)
    {
        return $this->deleteContent($id);
    }
    public function deleteFile($id)
    {
        $brand = BrandModel::where('brand_id', $id)->first();
        $file_path = public_path('/storage/' . $brand->brand_image);
        $brand->brand_image = "";
        $brand->save();
        if (file_exists($file_path)) {
            unlink($file_path);
            return MyHelper::response(true, 'Successfully', [], 200);
        } else {
            return MyHelper::response(true, 'File not exist', [], 404);
        }
    }
}
