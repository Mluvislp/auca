<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\WareHouseBill;
use App\Models\WarehouseBillMode;
use App\Models\WareHouseBillProduct;
use App\Models\WarehouseProduct;
use Auth;
use DB;
use JWTAuth;

trait WarehouseBillTrait {
    use WarehouseBillProductTrait;

    public function getAllWareHouseBill( $req ){
        try{
            $perPage    = $req->input( 'per_page' , 10 );
            $all_search = $req->all();
            $query      = WareHouseBill::query();
            $query      = $this->handleFilter( $query , $all_search );
            $list_mode  = ( new WarehouseBillMode() )->getAll();
            if( $list_mode ){
                $list_mode = $list_mode->toArray();
            }else{
                $list_mode = [];
            }
            $list = $query->select( 'wb_id' , 'w_id' , 'wb_type' , 'wb_mode' , 'sup_id' , 'wb_description' , 'wb_manual_discount_type' , 'wb_manual_discount' , 'wb_total_money' , 'wb_money' , 'user_id' , 'groupid' , 'created_at' )->with( 'wareHouseBillProduct' )->with( [
                'warehouse' => function( $query ){
                    $query->select( 'w_id' , 'w_name' , 'w_country_id' , 'w_country_iso' , 'user_id' , 'groupid' , 'created_at' , );
                }
            ] )->with( 'warehouseTransferFrom' )->with( 'warehouseTransferTo' )->with( 'user' )->paginate( $perPage );
            $data = [
                'data'         => collect( $list->items() )->map( function( $list ) use ( $list_mode ){
                    $list->view_id_and_time = $list->wb_id.'<br>'.timeStampToDate( $list->created_at );
                    $warehouse              = '';
                    $des                    = '';
                    switch( $list->wb_type ){
                        case 'Import' :
                            $type      = "Nhập";
                            $warehouse = $list->warehouse->w_name ?? '';
                            foreach( $list_mode as $mode ){
                                if( $mode[ 'wbm_id' ] == $list->wb_mode ){
                                    $des = $type.' '.$mode[ 'wbm_name' ];
                                }
                            }
                            break;
                        case 'Export' :
                            $type           = "Xuất";
                            $warehouse_from = $list->warehouseTransferFrom->w_name ?? $list->warehouse->w_name;
                            $warehouse_to   = $list->warehouseTransferTo->w_name ? '->'.$list->warehouseTransferTo->w_name : '';
                            $warehouse      = $warehouse_from.$warehouse_to;
                            foreach( $list_mode as $mode ){
                                if( $mode[ 'wbm_id' ] == $list->wb_mode ){
                                    $des = $type.' '.$mode[ 'wbm_name' ];
                                }
                            }
                            break;
                    }
                    $list->view_warehouse            = $warehouse.'<br>'.$des;
                    $list->view_total_product        = 0;
                    $list->view_quantity_product     = 0;
                    $list->view_total_money          = 0;
                    $list->view_total_discount_value = 0;
                    foreach( $list->wareHouseBillProduct as $bill_product ){
                        $list->view_total_product        = $list->view_total_product + 1;
                        $list->view_quantity_product     = $list->view_quantity_product + $bill_product->wbp_quantity;
                        $list->view_total_money          = $list->view_total_money + $bill_product->wbp_price;
                        $list->view_total_discount_value = $list->view_total_discount_value + $bill_product->wbp_discount_money;
                    }
                    $list->view_total_money = $list->view_total_money - $list->view_total_discount_value;
                    $list->view_user_name   = $list->user ? $list->user->user_name : "---";
                    unset( $list->user );
                    $list->view_description = $list->wb_description;
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
        if( array_key_exists( 'filter_groupid' , $all_search ) && !empty( $all_search[ 'filter_groupid' ] ) ){
            $query->where( 'groupid' , $all_search[ 'filter_groupid' ] );
        }
        if( array_key_exists( 'filter_wb_id' , $all_search ) && !empty( $all_search[ 'filter_wb_id' ] ) ){
            $query->where( 'wb_id' , $all_search[ 'filter_wb_id' ] );
        }
        if( array_key_exists( 'filter_wb_type' , $all_search ) && !empty( $all_search[ 'filter_wb_type' ] ) ){
            $query->where( 'wb_type' , $all_search[ 'filter_wb_type' ] );
        }
        if( array_key_exists( 'filter_wb_mode' , $all_search ) && !empty( $all_search[ 'filter_wb_mode' ] ) ){
            $query->whereIn( 'wb_mode' , $all_search[ 'filter_wb_mode' ] );
        }
        if( array_key_exists( 'filter_created_from' , $all_search ) && !empty( $all_search[ 'filter_created_from' ] ) ){
            $query->where( 'created_at' , '>=' , dateToTimeStamp( $all_search[ 'filter_created_from' ] ) );
        }
        if( array_key_exists( 'filter_created_to' , $all_search ) && !empty( $all_search[ 'filter_created_to' ] ) ){
            $query->where( 'created_at' , '<=' , dateToTimeStamp( $all_search[ 'filter_created_to' ] ) );
        }
        return $query;
    }

    public function createWareHouseBill( $validated , $is_request = true ){
        $user = JWTAuth::parseToken()->authenticate();
        try{
            DB::beginTransaction();
            $id                               = WareHouseBill::insertGetId( [
                'w_id'             => $validated[ 'w_id' ] ,
                'wb_type'          => $validated[ 'wb_type' ] ,
                'wb_mode'          => $validated[ 'wb_mode' ] ,
                'sup_id'           => $validated[ 'sup_id' ] ,
                'wb_customer_name' => $validated[ 'wb_customer_name' ] ,
                'wb_customer_tel'  => $validated[ 'wb_customer_tel' ] ,
                'wb_description'   => $validated[ 'wb_description' ] ,

                'wb_vat_type'      => $validated[ 'wb_vat_type' ] ,
                'wb_vat_value'     => $validated[ 'wb_vat_value' ] ,
                'wb_tax_bill_code' => $validated[ 'wb_tax_bill_code' ] ,
                'wb_tax_bill_date' => $validated[ 'wb_tax_bill_date' ] ,

                'wb_manual_discount_type' => $validated[ 'wb_manual_discount_type' ] ,
                'wb_manual_discount'      => $validated[ 'wb_manual_discount' ] ,
                //total price of product
                'wb_total_money'          => isset($validated[ 'wb_total_money' ]) ? $validated[ 'wb_total_money' ] : 0 ,

                'wb_money' => $validated[ 'wb_money' ] ,
                'ca_id'    => $validated[ 'ca_id' ] ,

                'wb_money_transfer' => $validated[ 'wb_money_transfer' ] ,
                'ta_id'             => $validated[ 'ta_id' ] ,
                'wb_debt_due_date'  => $validated[ 'wb_debt_due_date' ] ,

                'user_id'    => $user->user_id ,
                'groupid'    => $user->groupid ,
                'created_at' => time() ,
                'updated_at' => time() ,
            ] );
            $arr_id_product_bill_created      = [];
            $arr_id_product_warehouse_created = [];
            //handle create product bill
            if( $is_request ){
                if( $id ){
                    if( !empty( $validated[ 'product' ] ) ){
                        $total_money_product = 0;
                        foreach( $validated[ 'product' ] as $product ){
                            $total_money_product = $total_money_product + ( $product[ 'wbp_price' ] * $product[ 'wbp_quantity' ] );
                        }
                        foreach( $validated[ 'product' ] as $product ){
                            $res_update_price = true;
                            if( isset( $validated[ 'wb_update_import_price' ] ) ){
                                $res_update_price = $this->updateProductPrice( $product[ 'prd_id' ] , $product[ 'wbp_price' ] );
                            }
                            if( !empty( $validated[ 'wb_manual_discount' ] ) && $validated[ 'wb_manual_discount' ] > 0 ){
                                $tp                              = $product[ 'wbp_price' ] * $product[ 'wbp_quantity' ];
                                $p                               = $tp / $total_money_product;
                                $product[ 'wbp_discount_type' ]  = 'Money';
                                $product[ 'wbp_discount_value' ] = $p * $validated[ 'wb_manual_discount' ];
                                $product[ 'wbp_discount_money' ] = $p * $validated[ 'wb_manual_discount' ];
                            }else{
                                if( $product[ 'wbp_discount_type' ] == "Money" ){
                                    $product[ 'wbp_discount_money' ] = $product[ 'wbp_discount_value' ];
                                }elseif( $product[ 'wbp_discount_type' ] == "Percent" ){
                                    $product[ 'wbp_discount_money' ] = ( $product[ 'wbp_price' ] / 100 ) * $product[ 'wbp_discount_value' ];
                                }
                            }
                            $res_create_product_for_bill      = $this->createWareHouseBillProduct( $product , $id , false );
                            $res_create_product_for_warehouse = $this->exchangeDataForWarehouseProductAndCreate( $product , $validated[ 'w_id' ] , $validated[ 'wb_type' ] );
                            if( !$res_create_product_for_bill || !$res_create_product_for_warehouse || !$res_update_price ){
                                goto endfunc;
                            }
                            $arr_id_product_bill_created[]      = $res_create_product_for_bill;
                            $arr_id_product_warehouse_created[] = $res_create_product_for_warehouse;
                        }
                    }
                    DB::commit();
                    return MyHelper::response( true , 'Tạo mới thành công id : '.$id , [] , 200 );
                }
                endreq:
                if( !empty( $arr_id_product_bill_created ) ){
                    ( new WareHouseBillProduct() )->deleteMulti( $arr_id_product_bill_created );
                }
                if( !empty( $arr_id_product_warehouse_created ) ){
                    ( new WarehouseProduct() )->deleteMulti( $arr_id_product_warehouse_created );
                }
                DB::rollback();
                return MyHelper::response( false , 'Tạo mới thất bại' , [] , 400 );
            }else{
                if( $id ){
                    if( !empty( $validated[ 'product' ] ) ){
                        foreach( $validated[ 'product' ] as $product ){
                            $res_update_price = true;
                            if( isset( $validated[ 'wb_update_import_price' ] ) ){
                                $res_update_price = $this->updateProductPrice( $product[ 'prd_id' ] , $product[ 'wbp_price' ] );
                            }
                            $res_create_product_for_bill      = $this->createWareHouseBillProduct( $product , $id , false );
                            $type = "Import";
                            if(isset($validated[ 'wb_type' ]) && !empty($validated[ 'wb_type' ])){
                                $type = $validated[ 'wb_type' ];
                            }
                            $res_create_product_for_warehouse = $this->exchangeDataForWarehouseProductAndCreate( $product , $validated[ 'w_id' ] , $type);
                            if( !$res_create_product_for_bill || !$res_create_product_for_warehouse || !$res_update_price ){
                                goto endfunc;
                            }
                            $arr_id_product_bill_created[]      = $res_create_product_for_bill;
                            $arr_id_product_warehouse_created[] = $res_create_product_for_warehouse;
                        }
                    }

                    DB::commit();
                    return true;
                }
                endfunc:
                if( !empty( $arr_id_product_bill_created ) ){
                    ( new WareHouseBillProduct() )->deleteMulti( $arr_id_product_bill_created );
                }
                if( !empty( $arr_id_product_warehouse_created ) ){
                    ( new WarehouseProduct() )->deleteMulti( $arr_id_product_warehouse_created );
                }
                DB::rollback();
                return false;
            }
        }catch( \Exception $ex ){
            dd($ex);
            DB::rollback();
            if( $is_request ){
                return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
            }else{
                return false;
            }
        }
    }

    public function exchangeDataForWarehouseProductAndCreate( $product , $w_id , $type ){
        $data = [
            'w_id'                  => $w_id ,
            'prd_id'                => $product[ 'prd_id' ] ,
            'wp_quantity'           => $product[ 'wbp_quantity' ] ,
            'wp_quantity_defective' => $product[ 'wbp_quantity_defective' ] ,
            'type'                  => $type ,
        ];
        return $this->createWarehouseProduct( $data );
    }

    public function getAllWareHouseBillProduct( $req ){
        try{
            $perPage    = $req->input( 'per_page' , 10 );
            $all_search = $req->all();
            $query      = WareHouseBillProduct::query();
            $query      = $this->handleFilterWBP( $query , $all_search );
            $list_mode  = ( new WarehouseBillMode() )->getAll();
            if( $list_mode ){
                $list_mode = $list_mode->toArray();
            }
            $list = $query->with( [
                'warehousebill' => function( $query ){
                    $query->select( 'wb_id' , 'w_id' , 'wb_type' , 'wb_mode' , 'wb_description' , 'wb_manual_discount_type' , 'wb_manual_discount' , 'wb_total_money' , 'wb_description' , 'wb_money' , 'user_id' , 'groupid' , 'created_at' );
                }
            ] )->with( [
                'product' => function( $query ){
                    $query->select( 'prd_id' , 'prd_name' , 'prd_type_id' , 'prd_parent_id' , 'prd_code' , 'prd_barcode' , 'cat_id' , 'brand_id' , 'sup_id' , 'user_id' , 'groupid' , 'created_at' );
                }
            ] )->with( 'productOfWarehouse' )->paginate( $perPage );
            $data = [
                'data'         => collect( $list->items() )->map( function( $list ) use ( $list_mode ){
                    $list->view_id_and_time = $list->wbp_id.'<br>'.timeStampToDate( $list->warehousebill->created_at );
                    if( isset( $list->warehousebill->supplier->sup_name ) ){
                        $list->view_id_and_time = $list->view_id_and_time.'<br>'.$list->warehousebill->supplier->sup_name;
                    }
                    $warehouse = '';
                    $type      = "";
                    $supplier  = $list->warehousebill->supplier->sup_name ?? '';
                    switch( $list->wb_type ){
                        case 'Import' :
                            $type      = "Nhập";
                            $warehouse = $list->warehousebill->warehouse->w_name ? $list->warehousebill->warehouse->w_name : '';
                            break;
                        case 'Export' :
                            $type           = "Xuất";
                            $warehouse_from = $list->warehousebill->warehouseTransferFrom->w_name ?? $list->warehousebill->warehouse->w_name;
                            $warehouse_to   = $list->warehousebill->warehouseTransferTo->w_name ? '->'.$list->warehouseTransferTo->w_name : '';
                            $warehouse      = $warehouse_from.$warehouse_to;
                            break;
                    }
                    $list->view_warehouse    = $warehouse.'<br>'.$type.'<br>'.$supplier;
                    $list->view_parent_code  = $list->product->parent->prd_code ?? '';
                    $list->view_parent_name  = $list->product->parent->prd_name ?? '';
                    $list->view_product_name = $list->product->prd_name ?? '';

                    $list->view_total_of_bill      = $list->wbp_quantity ?? 0;
                    $list->view_unit               = $list->product->product_detail->pd_unit ?? '';
                    $list->view_total_product_of_w = 0;
                    if( $list->product_of_warehouse && count( $list->product_of_warehouse ) > 0 ){
                        foreach( $list->product_of_warehouse as $p ){
                            $list->view_total_product_of_w += $p->wp_quantity;
                        }
                    }
                    $list->view_price       = $list->wbp_price;
                    $list->view_cost_price  = $list->wbp_price;
                    $list->view_money       = $list->wbp_price * $list->wbp_quantity;
                    $list->view_discount    = $list->wbp_discount_money;
                    $list->view_total_money = $list->view_money - $list->view_discount;
                    $list->view_description = $list->wb_description;
                    $list->view_user_name   = $list->warehousebill->user->user_name ? $list->warehousebill->user->user_name : "---";
                    unset( $list->user );
                    return $list;
                } ) ,
                'total'        => $list->total() ,
                'per_page'     => $list->perPage() ,
                'current_page' => $list->currentPage() ,
            ];
            return MyHelper::response( true , 'Successfully' , $data , 200 );
        }catch( \Exception $e ){
            dd( $e );
            return MyHelper::response( false , 'Không thể lấy dữ liệu' , [] , 404 );
        }
    }

    public function handleFilterWBP( $query , $all_search ){
        if( array_key_exists( 'filter_groupid' , $all_search ) && !empty( $all_search[ 'filter_groupid' ] ) ){
            $query->where( 'groupid' , $all_search[ 'filter_groupid' ] );
        }
        if( array_key_exists( 'filter_w_id' , $all_search ) && !empty( $all_search[ 'filter_w_id' ] ) ){
            $query->whereHas( 'warehousebill' , function( $q ) use ( $all_search ){
                $q->where( 'wb_id' , $all_search[ 'filter_w_id' ] );
            } );
        }
        if( array_key_exists( 'filter_wbp_id' , $all_search ) && !empty( $all_search[ 'filter_wbp_id' ] ) ){
            $query->where( 'wbp_id' , $all_search[ 'filter_wbp_id' ] );
        }
        if( array_key_exists( 'filter_created_from' , $all_search ) && !empty( $all_search[ 'filter_created_from' ] ) ){
            $query->whereHas( 'warehousebill' , function( $q ) use ( $all_search ){
                $q->where( 'created_at' , '>=' , dateToTimeStamp( $all_search[ 'filter_created_from' ] ) );
            } );
        }
        if( array_key_exists( 'filter_created_to' , $all_search ) && !empty( $all_search[ 'filter_created_to' ] ) ){
            $query->whereHas( 'warehousebill' , function( $q ) use ( $all_search ){
                $q->where( 'created_at' , '<=' , dateToTimeStamp( $all_search[ 'filter_created_to' ] ) );
            } );
        }
        if( array_key_exists( 'filter_wb_type' , $all_search ) && !empty( $all_search[ 'filter_wb_type' ] ) ){
            $query->whereHas( 'warehousebill' , function( $q ) use ( $all_search ){
                $q->where( 'wb_type' , $all_search[ 'filter_wb_type' ] );
            } );
        }
        if( array_key_exists( 'filter_wb_mode' , $all_search ) && !empty( $all_search[ 'filter_wb_mode' ] ) ){
            $query->whereHas( 'warehousebill' , function( $q ) use ( $all_search ){
                $q->where( 'wb_mode' , $all_search[ 'filter_wb_mode' ] );
            } );
        }

        return $query;
    }

}
