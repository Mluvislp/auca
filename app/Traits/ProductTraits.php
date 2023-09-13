<?php

namespace App\Traits;
use App\Http\Functions\MyHelper;
use App\Models\LogProduct;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductStatus;
use App\Models\ProductType;
use App\Models\RelationProductVariantValue;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Milon\Barcode\DNS1D;

trait ProductTraits {
    use ProductDetailTraits , WarrantyTrait , WarehouseBillTrait, LogProductTraits;

    public function ListAll( $req ){
        try{
            $perPage    = $req->input( 'per_page' , 10 );
            $all_search = $req->all();
            $query      = Product::query();
            $query      = $this->handleFilter( $query , $all_search );
            //   dd($all_search);
            $list = $query->with( [
                'productDetail' => function( $query ){
                    $query->select( 'pd_id' , 'prd_id' , 'pd_import_price' , 'pd_vat' , 'pd_price' , 'pd_wholesale_price' , 'pd_old_price' , 'pd_shipping_weight' , 'pd_unit' , 'pd_lenght' , 'pd_width' , 'pd_height' , 'pd_image' , );
                }
            ] )->with( [
                'variantValues' => function( $query ){
                    $query->select( 'vv_parent_id' , 'var_id' , 'vv_name' , 'vv_value' , 'vv_other_name' , 'vv_code' , 'vv_other_code' , 'vv_unit' , );
                }
            ] )->with( [
                'supplier' => function( $query ){
                    $query->select( 'sup_id' , 'sup_name' , 'sup_code' , 'sup_tel' , 'sup_email' );
                }
            ] )->with('warehouseProduct')->paginate( $perPage );
            $data = [
                'data'         => collect( $list->items() )->map( function( $list ){
                    $totalQuantity = $list->warehouseProduct->sum('wp_quantity');
                    $list->total_quantity = $totalQuantity;
                    $totalQuantityDefective = $list->warehouseProduct->sum('wp_quantity_defective');
                    $list->total_quantity_defective = $totalQuantityDefective;
                    return $list;
                } ) ,
                'total'        => $list->total() ,
                'per_page'     => $list->perPage() ,
                'current_page' => $list->currentPage() ,
            ];
            return MyHelper::response( true , 'Successfully' , $data , 200 );
        }catch( \Exception $e ){
            return MyHelper::response( false , 'Không thể lấy dữ liệu' , [] , 404 );
        }
    }

    public function handleFilter( $query , $all_search ){
        if( array_key_exists( 'filter_w_id' , $all_search ) && !empty( $all_search[ 'filter_w_id' ] ) ){
            $query->where( 'w_id' , $all_search[ 'filter_w_id' ] );
        }
        if( array_key_exists( 'filter_prd_id' , $all_search ) && !empty( $all_search[ 'filter_prd_id' ] ) ){
            $query->where( 'prd_id' , $all_search[ 'filter_prd_id' ] );
        }
        if( array_key_exists( 'filter_prd_name_or_code' , $all_search ) && !empty( $all_search[ 'filter_prd_name_or_code' ] ) ){
            $query->where( function( $query ) use ( $all_search ){
                $searchTerm = "%".$all_search[ 'filter_prd_name_or_code' ]."%";
                $query->where( 'prd_name' , 'LIKE' , $searchTerm )->orWhere( 'prd_code' , 'LIKE' , $searchTerm );
            } );
        }
        if( array_key_exists( 'filter_cat_id' , $all_search ) && !empty( $all_search[ 'filter_cat_id' ] ) ){
            $query->whereIn( 'cat_id' , $all_search[ 'filter_cat_id' ] );
        }
        if( array_key_exists( 'filter_prd_parent_id' , $all_search ) && !empty( $all_search[ 'filter_prd_parent_id' ] ) ){
            $query->where( 'prd_parent_id' , $all_search[ 'filter_prd_parent_id' ] );
        }
        if( array_key_exists( 'filter_prd_imei' , $all_search ) && !empty( $all_search[ 'filter_prd_imei' ] ) ){
            $query->where( 'prd_imei' , $all_search[ 'filter_prd_imei' ] );
        }
        if( array_key_exists( 'filter_prd_imei' , $all_search ) && !empty( $all_search[ 'filter_prd_imei' ] ) ){
            $query->whereHas( 'productDetail' , function( $q ) use ( $all_search ){
                $q->where( 'prd_imei' , $all_search[ 'filter_prd_imei' ] );
            } );
        }
        if( array_key_exists( 'filter_brand_id' , $all_search ) && !empty( $all_search[ 'filter_brand_id' ] ) ){
            $query->where( 'brand_id' , $all_search[ 'filter_brand_id' ] );
        }
        if( array_key_exists( 'filter_price_type' , $all_search ) && !empty( $all_search[ 'filter_price_type' ] ) ){
            $type = 'pd_import_price';
            switch( $all_search[ 'filter_price_type' ] ){
                case 1:
                    $type = 'pd_import_price';
                    break;
                case 2:
                    $type = 'pd_price';
                    break;
                case 3:
                    $type = 'pd_old_price';
                    break;
            }
            if( array_key_exists( 'filter_price_form' , $all_search ) && !empty( $all_search[ 'filter_price_form' ] ) ){
                $query->whereHas( 'productDetail' , function( $q ) use ( $all_search , $type ){
                    $q->where( $type , '>=' , $all_search[ 'filter_price_form' ] );
                } );
            }
            if( array_key_exists( 'filter_price_to' , $all_search ) && !empty( $all_search[ 'filter_price_to' ] ) ){
                $query->whereHas( 'productDetail' , function( $q ) use ( $all_search , $type ){
                    $q->where( $type , '<=' , $all_search[ 'filter_price_to' ] );
                } );
            }
        }
        if( array_key_exists( 'filter_child_parent' , $all_search ) && !empty( $all_search[ 'filter_child_parent' ] ) ){
            switch( $all_search[ 'filter_child_parent' ] ){
                case 1:
                    //cha
                    $query->has( 'children' );
                    break;
                case 2:
                    //doc lap
                    $query->whereDoesntHave( 'children' )->whereDoesntHave( 'parent' );
                    break;
                case 3:
                    //con
                    $query->has( 'parent' );
                    break;
                case 4:
                    //cha + doc lap
                    $query->where( function( $query ){
                        $query->whereHas( 'children' )->orWhereNull( 'prd_parent_id' );
                    } );
                    break;
                case 5:
                    //con + doc lap
                    $query->where( function( $query ){
                        $query->whereHas( 'parent' )->orWhereNull( 'prd_parent_id' );
                    } );
                    break;
                default :
                    break;
            }
        }
        if( array_key_exists( 'filter_prd_type_id' , $all_search ) && !empty( $all_search[ 'filter_prd_type_id' ] ) ){
            $query->where( 'prd_type_id' , $all_search[ 'filter_prd_type_id' ] );
        }
        if( array_key_exists( 'filter_features' , $all_search ) && !empty( $all_search[ 'filter_features' ] ) ){
            foreach( $all_search[ 'filter_features' ] as $val ){
                switch( $val ){
                    case 1 :
                        if( !in_array( 2 , $all_search[ 'filter_features' ] ) ){
                            $query->whereHas( 'productDetail' , function( $q ){
                                $q->whereNull( 'pd_image' );
                            } );
                        }
                        break;
                    case 2 :
                        if( !in_array( 1 , $all_search[ 'filter_features' ] ) ){
                            $query->whereHas( 'productDetail' , function( $q ){
                                $q->whereNotNull( 'pd_image' );
                            } );
                        }
                        break;
                    case 3 :
                        $query->where( 'prd_status_id' , 1 );
                        break;
                    case 4 :
                        $query->whereHas( 'productDetail' , function( $q ){
                            $q->whereNull( 'pd_vat' )->orWhere( 'pd_vat' , 0 );
                        } );
                        break;
                    case 5 :
                        $query->whereHas( 'productDetail' , function( $q ){
                            $q->whereNotNull( 'pd_vat' )->orWhere( 'pd_vat' , '>' , 0 );
                        } );
                        break;
                    case 6 :
                        $query->whereHas( 'productDetail' , function( $q ){
                            $q->whereNotNull( 'pd_shipping_weight' )->orWhere( 'pd_shipping_weight' , '>' , 0 );
                        } );
                        break;
                    case 7 :
                        $query->whereHas( 'productDetail' , function( $q ){
                            $q->whereNull( 'pd_shipping_weight' )->orWhere( 'pd_shipping_weight' , 0 );
                        } );
                        break;
                }
            }
        }
        if( array_key_exists( 'filter_cat_inter_id' , $all_search ) && !empty( $all_search[ 'filter_cat_inter_id' ] ) ){
            $query->whereIn( 'cat_inter_id' , $all_search[ 'filter_cat_inter_id' ] );
        }
        if( array_key_exists( 'filter_sup_name' , $all_search ) && !empty( $all_search[ 'filter_sup_name' ] ) ){
            $supplierName = $all_search[ 'filter_sup_name' ];
            $query->whereHas( 'supplier' , function( $query ) use ( $supplierName ){
                $query->where( 'sup_name' , 'LIKE' , $supplierName.'%' );
            } );
        }
        if( array_key_exists( 'filter_created_from' , $all_search ) && !empty( $all_search[ 'filter_created_from' ] ) ){
            $query->where( 'created_at' , '>=' , dateToTimeStamp( $all_search[ 'filter_created_from' ] ) );
        }
        if( array_key_exists( 'filter_created_to' , $all_search ) && !empty( $all_search[ 'filter_created_to' ] ) ){
            $query->where( 'created_at' , '<=' , dateToTimeStamp( $all_search[ 'filter_created_to' ] ) );
        }
        if( array_key_exists( 'filter_prd_status_id' , $all_search ) && !empty( $all_search[ 'filter_prd_status_id' ] ) ){
            switch( $all_search[ 'filter_prd_status_id' ] ){
                case 0:
                    $query->where( 'prd_status_id' , 0 );
                    break;
                case 1:
                    $query->where( 'prd_status_id' , 1 );
                    break;
                case 2:
                    $query->where( 'prd_status_id' , 2 );
                    break;
                case 3:
                    $query->where( 'prd_status_id' , 3 );
                    break;
                case 4:
                    $query->where( 'prd_status_id' , 4 );
                    break;
            }
        }
        return $query;
    }

    public function createProduct( $validated , $is_request = true){
        $user = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $barcode     = genarateBarcode( $validated[ 'prd_barcode' ] );
            $arr_general = [
                'groupid'    => $user->groupid ,
                'user_id'    => $user->user_id ,
                'created_at' => time() ,
                'updated_at' => time() ,
            ];
            $new_id      = Product::insertGetId( [
                'prd_name'      => $validated[ 'prd_name' ] ,
                'prd_type_id'   => $validated[ 'prd_type_id' ] ,
                'prd_code'      => $validated[ 'prd_code' ] ,
                'prd_barcode'   => $barcode ,
                'prd_status_id' => $validated[ 'prd_status_id' ] ,
                'cat_id'        => $validated[ 'cat_id' ] ,
                'cat_inter_id'  => $validated[ 'cat_inter_id' ] ,
                'brand_id'      => $validated[ 'brand_id' ] ,
                'sup_id'        => $validated[ 'sup_id' ] ,
                'groupid'       => $arr_general[ 'groupid' ] ,
                'user_id'       => $arr_general[ 'user_id' ] ,
                'created_at'    => $arr_general[ 'created_at' ] ,
                'updated_at'    => $arr_general[ 'updated_at' ] ,
            ] );
            $check       = [
                'status'  => true ,
                'prd_id'  => false ,
                'message' => []
            ];
            if( $new_id ){
                $check['prd_id'] = $new_id;
                if( !empty( $validated[ 'parent_attr' ] ) ){
                    foreach( $validated[ 'parent_attr' ] as $key => $val ){
                        $create_vv = RelationProductVariantValue::create( [
                            'prd_id' => $new_id ,
                            'vv_id'  => $val['vv_id'] ,
                        ] );
                        if( !$create_vv ){
                            $check[ 'status' ] = false;
                            array_push( $check[ 'message' ] , "Tạo sản phẩm với thuộc tính id : ".$val[ 'var_id' ]."  thất bại" );
                            goto out;
                        }
                    }
                }
                //create product detail
                $create_product_detail = $this->createProductDetail( $validated , $new_id , $arr_general );
                if( !$create_product_detail ){
                    $check[ 'status' ] = false;
                    array_push( $check[ 'message' ] , "Tạo sản phẩm thất bại" );
                    goto out;
                }
                //create waranty
                $create_waranty = $this->createWarranty( $validated , $new_id , $arr_general );
                if( !$create_waranty ){
                    $check[ 'status' ] = false;
                    array_push( $check[ 'message' ] , "Tạo bảo hành thất bại" );
                    goto out;
                }
                //create child product
                if( isset($validated[ 'attribute_combinated' ] ) && !empty( $validated[ 'attribute_combinated' ] ) && is_array( $validated[ 'attribute_combinated' ] )  ){
                    foreach( $validated[ 'attribute_combinated' ] as $key => $child ){
                        $create_child = $this->createChildProduct( $validated , $child , $new_id , $arr_general );
                        if( !$create_child[ 'status' ] ){
                            $check[ 'status' ] = false;
                            array_push( $check[ 'message' ] , $create_child[ 'message' ] );
                            goto out;
                        }else{
                            $validated[ 'attribute_combinated' ][$key]['prd_id'] = $create_child['data'];
                        }
                    }
                }
                //dang sai
                //create warehouse product + warehouse bill
                $createWarehouse = $this->createDataForWarehouse($validated , $new_id);
                if( !$createWarehouse['status'] ){
                    $check[ 'status' ] = false;
                    array_push( $check[ 'message' ] , $createWarehouse['message'] );
                    goto out;
                }
            }
            out:
            if( !$check[ 'status' ] ){
                DB::rollBack();
                if($is_request){
                    return MyHelper::response( false , 'Tạo mới thất bại' , $check[ 'message' ] , 500 );
                }else{
                    return $check;
                }
            }
            DB::commit();
            if($is_request){
                return MyHelper::response( true , 'Tạo mới thành công id : '.$new_id , [] , 200 );
            }else{
                return $check;
            }
        }catch( \Exception $ex ){
            DB::rollback();
            if($is_request){
                return MyHelper::response( false , 'Tạo mới thất bại' , [] , 500 );
            }else{
                return [
                    'status'  => true ,
                    'message' => [$ex]
                ];
            }
        }
    }

    public function createChildProduct( $validated , $extend , $parent_id , $arr_general ){
        try{
            DB::beginTransaction();
            $barcode = genarateBarcode( $extend['extend_barcode'] );
            $new_id  = Product::insertGetId( [
                'prd_name'      => $validated['prd_name'].' '.$extend['extend_name'] ,
                'prd_type_id'   => $validated[ 'prd_type_id' ] ,
                'prd_parent_id' => $parent_id ,
                'prd_code'      => $validated['prd_code'].' '.$extend['extend_code'] ,
                'prd_barcode'   => $barcode ,
                'prd_status_id' => $validated[ 'prd_status_id' ] ,
                'cat_id'        => $validated[ 'cat_id' ] ,
                'cat_inter_id'  => $validated[ 'cat_inter_id' ] ,
                'brand_id'      => $validated[ 'brand_id' ] ,
                'sup_id'        => $validated[ 'sup_id' ] ,
                'groupid'       => $arr_general[ 'groupid' ] ,
                'user_id'       => $arr_general[ 'user_id' ] ,
                'created_at'    => $arr_general[ 'created_at' ] ,
                'updated_at'    => $arr_general[ 'updated_at' ] ,
            ] );
            $check   = [
                'status'  => true ,
                'message' => []
            ];
            if( $new_id ){
                if( !empty( $extend['attr'] ) ){
                    foreach( $extend['attr'] as $val ){
                        $create_vv = RelationProductVariantValue::create( [
                            'prd_id' => $new_id ,
                            'vv_id'  => $val['vv_id'] ,
                        ] );
                        if( !$create_vv ){
                            $check[ 'status' ] = false;
                            array_push( $check[ 'message' ] , "Tạo sản phẩm con với thuộc tính id : ".$val->var_id."  thất bại" );
                            goto out;
                        }
                    }
                }
                //create product detail
                $create_product_detail = $this->createProductDetailForChild( $validated , $new_id , $extend , $arr_general );
                if( !$create_product_detail ){
                    $check[ 'status' ] = false;
                    array_push( $check[ 'message' ] , "Tạo sản phẩm con thất bại" );
                    goto out;
                }
                //create waranty
                $create_waranty = $this->createWarranty( $validated , $new_id , $arr_general );
                if( !$create_waranty ){
                    $check[ 'status' ] = false;
                    array_push( $check[ 'message' ] , "Tạo bảo hành cho sản phẩm con id :".$new_id." thất bại" );
                    goto out;
                }
            }
            out:
            if( !$check[ 'status' ] ){
                DB::rollBack();
                return $check;
            }else{
                $check[ 'message' ] = 'Sản phẩm con id : '.$new_id;
                $check[ 'data' ] = $new_id;
            }
            DB::commit();
            return $check;
        }catch( \Exception $ex ){
            $check = [
                'status'  => false ,
                'message' => [
                    'Lỗi khi lưu dữ liệu'
                ]
            ];
            DB::rollback();
            return $check;
        }
    }

    public function createDataForWarehouse( $validated , $prd_id ){
        $arr_product                         = [];
        $total_price_import                  = 0;
        if( isset( $validated[ 'pd_first_remain' ] ) && !empty( $validated[ 'pd_first_remain' ] ) && (int)$validated[ 'pd_first_remain' ] > 0 ){
            if(!isset($validated[ 'w_id' ]) || empty($validated[ 'w_id' ]) ){
                return [
                    'status'  => false ,
                    'message' => 'Chưa có địa chỉ kho tạo tồn đầu'
                ];
            }
        }
        if( isset($validated[ 'attribute_combinated' ] ) && !empty( $validated[ 'attribute_combinated' ] ) && is_array( $validated[ 'attribute_combinated' ] )  ){
            foreach( $validated[ 'attribute_combinated' ] as $child ){
                if( (int)$child[ 'extend_quantity' ] == 0 ){
                    continue; // Bỏ qua vòng lặp nếu extend_quantity là 0
                }
                if( isset( $validated[ 'pd_first_remain' ] ) && !empty( $validated[ 'pd_first_remain' ] ) && (int)$validated[ 'pd_first_remain' ] > 0 ){
                    return [
                        'status'  => false ,
                        'message' => 'Không thể cùng lúc tạo tồn đầu vừa thêm sản phẩm con'
                    ];
                }
                if( isset( $child[ 'extend_quantity' ] ) && !empty( $child[ 'extend_quantity' ] ) && (int)$child[ 'extend_quantity' ] > 0 ){
                    if( !isset( $validated[ 'w_id' ] ) || empty( $validated[ 'w_id' ] ) ){
                        return [
                            'status'  => false ,
                            'message' => 'Chưa có địa chỉ kho tạo tồn đầu'
                        ];
                    }
                }
                $total_price_import += $child[ 'extend_quantity' ] * $child[ 'extend_price' ];
                $arr_product[]      = [
                    'prd_id'                 => $child[ 'prd_id' ] ,
                    'wbp_quantity'           => $child[ 'extend_quantity' ] ,
                    'wbp_quantity_defective' => 0 ,
                    'wbp_price'              => $child[ 'extend_price' ] ? $child[ 'extend_price' ] :  $validated[ 'pd_import_price' ]  ,
                    'wbp_discount_type'      => 'Money' ,
                    'wbp_discount_value'     => 0 ,
                    'wbp_discount_money'     => 0 ,
                    'wbp_shipping_weight'    => $child[ 'extend_shipping_weight' ] ? $child[ 'extend_shipping_weight' ] :$validated[ 'pd_shipping_weight' ] ,
                    'wbp_note'               => '' ,
                ];
            }
            $wb_description = 'Nhập tồn đầu khi thêm sản phẩm mới có thuộc tính';
        }
        if( isset( $validated[ 'pd_first_remain' ] ) && !empty( $validated[ 'pd_first_remain' ] ) && $validated[ 'pd_first_remain' ] > 0 ){
            $arr_product[]      = [
                'prd_id'                 => $prd_id ,
                'wbp_quantity'           => $validated[ 'pd_first_remain' ] ,
                'wbp_quantity_defective' => 0 ,
                'wbp_price'              => $validated[ 'pd_import_price' ] ,
                'wbp_discount_type'      => 'Money' ,
                'wbp_discount_value'     => 0 ,
                'wbp_discount_money'     => 0 ,
                'wbp_shipping_weight'    => $validated[ 'pd_shipping_weight' ] ?? 0 ,
                'wbp_note'               => '' ,
            ];
            $wb_description     = 'Nhập khi tạo sản phẩm';
            $total_price_import += $validated[ 'pd_first_remain' ] * $validated[ 'pd_import_price' ];
        }
        if(empty($arr_product)){
            return [
                'status'  => true ,
                'message' => ''
            ];
        }
        $data = [
            'w_id'                    => $validated[ 'w_id' ] ,
            'sup_id'                  => $validated[ 'sup_id' ] ,
            'wb_type'                 => 'Import' ,
            'wb_mode'                 => 1 ,
            'wb_customer_name'        => null ,
            'wb_customer_tel'         => null ,
            'wb_description'          => $wb_description ,
            'wb_manual_discount_type' => "Money" ,
            'wb_manual_discount'      => 0 ,
            'wb_total_money'          => $total_price_import ,
            'wb_money'                => null ,
            'ca_id'                   => null ,
            'wb_money_transfer'       => null ,
            'ta_id'                   => null ,
            'wb_debt_due_date'        => null ,
            'wb_vat_type'             => null ,
            'wb_vat_value'            => null ,
            'wb_tax_bill_code'        => null ,
            'wb_tax_bill_date'        => null ,
            'product'                 => $arr_product
        ];
        $create = $this->createWareHouseBill($data , false);
        if(!$create){
            return [
                'status'  => false ,
                'message' => 'Tạo sản phẩm cho kho được chọn thất bại'
            ];
        }
        return [
            'status'  => true ,
            'message' => ''
        ];
    }

    public function findProduct( $req ){
        try{
            $req = $req->all();
            if( !array_key_exists( 'id' , $req ) ){
                return MyHelper::response( false , 'Gía trị tìm kiếm không hợp lệ' , [] , 500 );
            }
            $product = Product::where( 'prd_id' , $req[ 'id' ] )->with( [
                'productDetail' => function( $query ){
                    $query->select( 'pd_id' , 'prd_id' , 'pd_import_price' , 'pd_vat' , 'pd_price' , 'pd_wholesale_price' , 'pd_old_price' , 'pd_shipping_weight' , 'pd_unit' , 'pd_lenght' , 'pd_width' , 'pd_height' , 'pd_image'  );
                }
            ] )->with( [ 'warranty' => function ($query) {
                $query->with('country');
            }] )->with( 'variantValues' )->with( 'parent' )->with( 'type' )->with( 'categories' )->with( 'categoryInternal' )->with( 'brand' )->first();
            if( $product ){
                return MyHelper::response( true , 'Thành công' , $product , 200 );
            }else{
                return MyHelper::response( false , 'Không tìm thấy sản phẩm' , $product , 404 );
            }
        }catch( \Exception $ex ){
            dd($ex);
            return MyHelper::response( false , 'Không tìm thấy giá trị hợp lệ' , [] , 500 );
        }
    }

    public function updateProduct( $validated ){
        try{
            DB::beginTransaction();
            $model = ( new Product() )->findFirstById( $validated[ 'prd_id' ] );
            if( !$model ){
                return MyHelper::response( false , 'Không tìm thấy sản phẩm' , [] , 500 );
            }
            $old_product = $model->toArray();
            $message        = [];
            $update_product = $model->update( [
                'prd_name'      => $validated[ 'prd_name' ] ,
                'prd_type_id'   => $validated[ 'prd_type_id' ] ,
                'prd_parent_id' => $validated[ 'prd_parent_id' ] ,
                'prd_code'      => $validated[ 'prd_code' ] ,
                'prd_barcode'   => $validated[ 'prd_barcode' ] ,
                'prd_status_id' => $validated[ 'prd_status_id' ] ,
                'cat_id'        => $validated[ 'cat_id' ] ,
                'cat_inter_id'  => $validated[ 'cat_inter_id' ] ,
                'brand_id'      => $validated[ 'brand_id' ] ,
                'updated_at'    => time() ,
            ] );
            //UPDATE VARIANT
            $model->variantValues()->detach();
            if( !empty( $validated[ 'parent_attr' ] ) ){
                foreach( $validated[ 'parent_attr' ] as $key => $val ){
                    $create_vv = RelationProductVariantValue::create( [
                        'prd_id' => $validated[ 'prd_id' ] ,
                        'vv_id'  => $val['vv_id'] ,
                    ] );
                    if( !$create_vv ){
                        $check[ 'status' ] = false;
                        array_push( $check[ 'message' ] , "Tạo sản phẩm với thuộc tính id : ".$val[ 'var_id' ]."  thất bại" );
                        goto endupdate;
                    }
                }
            }
            if( !$update_product ){
                $message[] = [
                    'status'  => false ,
                    'message' => 'Cập nhật thất bại'
                ];
                goto endupdate;
            }
            //UPDATE PRODUCT DETAIL
            if( !empty( $validated[ 'pd_image' ] ) || !empty( $validated[ 'pd_import_price' ] ) || !empty( $validated[ 'pd_vat' ] ) || !empty( $validated[ 'pd_price' ] ) || !empty( $validated[ 'pd_wholesale_price' ] ) || !empty( $validated[ 'pd_old_price' ] ) || !empty( $validated[ 'pd_shipping_weight' ] ) || !empty( $validated[ 'pd_unit' ] ) || !empty( $validated[ 'pd_lenght' ] ) || !empty( $validated[ 'pd_width' ] ) || !empty( $validated[ 'pd_height' ] ) ){
                $update_detail = $this->updateProductDetail( $validated , $old_product );
                if( !$update_detail ){
                    $message[] = [
                        'status'  => false ,
                        'message' => 'Cập nhật thất bại'
                    ];
                    goto endupdate;
                };
            }
            if( !empty( $validated[ 'country_id' ] ) || !empty( $validated[ 'wa_address' ] ) || !empty( $validated[ 'wa_tel' ] ) || !empty( $validated[ 'wa_num_month' ] ) || !empty( $validated[ 'wa_content' ] ) ){
                $update_warranty = $this->updateWarranty( $validated );
                if( !$update_warranty ){
                    $message[] = [
                        'status'  => false ,
                        'message' => 'Cập nhật giá trị bảo hành thất bại'
                    ];
                    goto endupdate;
                };
            }
            endupdate:
            if( !empty( $message ) ){
                DB::rollback();
                return MyHelper::response( false , 'Cập nhật thất bại' , $message , 500 );
            }
            //$this->addLog($validated , $old_product , $old_product);
            DB::commit();
            return MyHelper::response( true , 'Cập nhật thành công id : '.$validated[ 'prd_id' ] , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }

    public function deleteProduct( $req ){
        try{
            DB::beginTransaction();
            $validator = Validator::make( $req->all() , [
                'id' => 'required|integer' ,
            ] );
            if( $validator->fails() ){
                return MyHelper::response( false , 'Kiểm tra lại định dạng dữ liệu' , [] , 404 );
            }
            $req   = $req->all();
            $model = Product::find( $req[ 'id' ] );
            if( !$model ){
                return MyHelper::response( false , 'Không tìm thấy dữ liệu' , [] , 404 );
            }
            $old_val = $model->toArray();
            $model->productDetail()->delete();
            $model->variantValues()->detach();
            $model->warranty()->delete();
            $deleted = $model->delete();
            if( $deleted ){
                $this->addLog([] , [],$old_val);
                DB::commit();
                return MyHelper::response( true , 'Xoá thành công id : '.$req[ 'id' ] , [] , 200 );
            }else{
                DB::rollback();
                return MyHelper::response( false , 'Không thành công' , [] , 404 );
            }
        }catch( \Exception $e ){
            DB::rollback();
            return MyHelper::response( false , 'Không thể xoá sản phẩm: '.$e->getMessage() , [] , 404 );
        }
    }

    public function getAllProductType(){
        $data = ( new ProductType() )->getAll();
        return $data;
    }
    public function getAllProductTypeApi(){
        $data = ( new ProductType() )->getAll();
        if($data){
            return MyHelper::response( true , 'Successfully' , $data , 200 );
        }else{
            return MyHelper::response( false , 'No data found' , [] , 400 );
        }
    }

    public function getAllProductStatus(){
        $data = ( new ProductStatus() )->getAll();
        return $data;
    }
    public function getAllProductStatusApi(){
        $data = ( new ProductStatus() )->getAll();
        if($data){
            return MyHelper::response( true , 'Successfully' , $data , 200 );
        }else{
            return MyHelper::response( false , 'No data found' , [] , 400 );
        }
    }

    public function fastUploadImg( $validated ){
        $pd_image = $validated[ 'pd_image' ];
        if( !is_null( $pd_image ) ){
            $upload = checkIsImageAndUpLoad( $pd_image );
            if( !$upload ){
                return MyHelper::response( false , 'Tải lên thất bại' , [] , 500 );
            }else{
                $product_detail = ( new ProductDetail() )->findFirstByProductId( $validated[ 'pd_id' ] );
                if( $product_detail ){
                    $product_detail->update( [
                        'pd_image' => $upload
                    ] );
                    return MyHelper::response( true , 'Tải lên thành công ' , $upload , 200 );
                }else{
                    return MyHelper::response( false , 'Không tìm thấy sản phẩm' , [] , 500 );
                }
            }
        }
    }


    public function getProduct ($id) {
      return ( new Product() )->findFirstById($id);
    }
    public function getProductForbarcode ($id) {
        try{
            $product = Product::where( 'prd_id' , $id )->with( [
                'productDetail' => function( $query ){
                    $query->select( 'pd_id' , 'prd_id' , 'pd_import_price' , 'pd_vat' , 'pd_price' , 'pd_wholesale_price' , 'pd_old_price' , 'pd_shipping_weight' , 'pd_unit' , 'pd_lenght' , 'pd_width' , 'pd_height' , 'pd_image'  );
                }
            ] )->first();
            if( $product ){
                return $product;
            }else{
                return false;
            }
        }catch( \Exception $ex ){
            return false;
        }
    }


}
