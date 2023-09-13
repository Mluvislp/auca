<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Functions\MyHelper;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\FastUploadRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Traits\BarcodeTraits;
use App\Traits\ProductTraits;
use App\Traits\WarehouseProductTrait;
use Illuminate\Http\Request;
use JWTAuth;

class ProductController extends Controller {
    use ProductTraits , BarcodeTraits, WarehouseProductTrait;

    public function getAll( Request $request ){
        return $this->ListAll( $request );
    }

    public function create( CreateProductRequest $request ){
        $req = $request->validated();
        return $this->createProduct( $req );
    }

    public function find(Request $request){
        return $this->findProduct($request);
    }

    public function delete(Request $request){
        return $this->deleteProduct($request);
    }


    public function update(UpdateProductRequest $request){
        $validated = $request->validated();
        return $this->updateProduct($validated);
    }

    public function productType(Request $request){
        return $this->getAllProductTypeApi($request);
    }

    public function productStatus(Request $request){
        return $this->getAllProductStatusApi($request);
    }

    public function ListAllSelect( Request $request ){
        $user    = JWTAuth::parseToken()->authenticate();
        $product = Product::where( 'groupid' , $user->groupid )->get();
        return MyHelper::response( true , 'Successfully' , $product , 200 );
    }

    public function ShowOne( Request $request , $id ){
        $user    = JWTAuth::parseToken()->authenticate();
        $product = Product::where( 'groupid' , $user->groupid )->where( 'prd_id' , $id )->first();
        return MyHelper::response( true , 'Successfully' , $product , 200 );
    }

    public function fastUpload(FastUploadRequest $request){
        return $this->fastUploadImg( $request );
    }

    public function Select2Fucntion( Request $request ){
      $user    = JWTAuth::parseToken()->authenticate();
      $query = Product::query();
      $keyword = $request->input('search');
      if (!empty($keyword)) {
        $query->where('prd_name', 'LIKE', "%$keyword%");
      }
      $product = $query->select('prd_id', 'prd_name')->get();
      return MyHelper::response( true , 'Successfully' , $product , 200 );
    }

    public function barCode(Request $request){
        $request = $request->all();
        if(!array_key_exists('prd_id' , $request) || empty($request['prd_id'])){
            return MyHelper::response( false , 'Kiểm tra lại dữ liệu đầu vào' , [] , 400 );
        }
        if(!array_key_exists('w_id' , $request) || empty($request['w_id'])){
            return MyHelper::response( false , 'Kiểm tra lại dữ liệu đầu vào' , [] , 400 );
        }
        $product = $this->getProductByIdAndWarehouse($request['prd_id'] , $request['w_id']);
        if(!$product){
            return MyHelper::response( false , 'Không tìm thấy sản phẩm hợp lệ' , [] , 400 );
        }
        $bar_code = $this->genBarCode($product->product->prd_barcode);
        $arr_response = [
          'html' => $bar_code,
          'warehouse_name' => $product->warehouse->w_name,
          'product_name' => $product->product->prd_name,
        ];
        return MyHelper::response( true , 'Successfully' , $arr_response , 200 );
    }
}
