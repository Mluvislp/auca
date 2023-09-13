<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Functions\MyHelper;
use App\Http\Requests\Package\CreatePackageRequest;
use App\Http\Requests\Package\ExtractPackageRequest;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WarehouseProductArchive;
use App\Traits\PackageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller {

    use PackageTrait;


    public function create( CreatePackageRequest $request ){
        $validated = $request->validated();
        DB::beginTransaction();
        try{
            $total_money = 0;
            foreach( $validated[ 'product' ] as $product ){
                $price_of_product = $product[ 'p_quantity' ] * $product[ 'p_price' ];
                $total_money      += $price_of_product;
            }
            $validated[ 'total_money' ] = $total_money;
            //tao san pham + nhap kho cho goi
            $in = $this->exchangeDataForProductAndCreate( $validated );
            //tao export cho san pham cuar goi
            $out = $this->exchangeDataForBillExportAndCreate( $validated );
            if( $in && $out ){
                DB::commit();
                return MyHelper::response( true , 'Tạo mới thành công' , [] , 200 );
            }else{
                DB::rollback();
                return MyHelper::response( false , 'Tạo mới thất bại' , [] , 500 );
            }
        }catch( \Exception $ex ){
            DB::rollback();
            return false;
        }
    }

    public function extract( Request $validated ){
        DB::beginTransaction();
        try{
            $request = $validated->all();
            $arr_pack_err = [];
            foreach( $request as $key => $pack_extract ){
                if( startsWith( $key , 'w_id' ) && !empty($validated['w_id'])){
                    $check_w = Warehouse::where( 'w_id' , $validated[ 'w_id' ] )->exists();
                    if( !$check_w ){
                        return MyHelper::response( false , 'Không tìm thấy kho hàng' , [] , 500 );
                    }
                }
                if( !startsWith( $key , 'pack_' ) ){
                    continue;
                }
                $pack_info = Product::where('prd_id' , $pack_extract['prd_id'])
                    ->where('prd_type_id' , 5)
                    ->with('productOfPack')
                    ->with('productDetail')
                    ->select(
                        'prd_id',
                        'prd_name',
                        'prd_code',
                        'prd_barcode',
                        'prd_status_id',
                        'groupid',
                        'user_id',
                    )
                    ->first();
                if(!$pack_info){
                    $arr_pack_err[] = $pack_extract['prd_id'];
                    continue;
                }
                $pack_info = $pack_info->toArray();
                $pack_info ['w_id'] = $validated['w_id'];
                $out =  $this->createExportForPack($pack_extract , $pack_info);
                $in = $this->exchangeDataForBillImportAndCreate($pack_extract , $pack_info);
                if( !$in || !$out ){
                    $arr_pack_err[] = $pack_extract['prd_id'];
                }
            }
            if( empty($arr_pack_err) ){
                DB::commit();
                return MyHelper::response( true , 'Tạo mới thành công' , [] , 200 );
            }else{
                DB::rollback();
                return MyHelper::response( false , 'Đã có lỗi xảy ra vui lòng kiểm tra lại dữ liệu' , $arr_pack_err , 500 );
            }
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , 'Tạo mới thất bại' , [] , 500 );
        }
    }
}
