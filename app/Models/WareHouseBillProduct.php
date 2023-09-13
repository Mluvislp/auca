<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouseBillProduct extends Model {
    use HasFactory;

    protected $table      = 'warehouse_bill_product';
    public    $timestamps = false;
    protected $primaryKey = 'wbp_id';
    protected $fillable   = [
        'wbp_id' ,
        'wb_id' ,
        'prd_id' ,
        'wbp_quantity' ,
        'wbp_quantity_defective' ,
        'wbp_price' ,
        'wbp_discount_type' ,
        'wbp_discount_value' ,
        'wbp_discount_money' ,
        'wbp_shipping_weight' ,
        'wbp_note' ,
        'groupid' ,
    ];

    public function deleteMulti( $arr = [] ){
        if( !empty( $arr ) ){
            $this->whereIn( 'wbp_id' , $arr )->delete();
        }
        return true;
    }

    //Bill product 1-1 product
    public function product(){
        return $this->belongsTo( Product::class , 'prd_id' )
            ->with( 'parent' )
            ->with([
                'productDetail' => function( $query ){
                    $query->select( 'pd_id' , 'prd_id' , 'pd_unit' , 'groupid' );
                }
            ]);
    }

    public function productOfWarehouse(){
        return $this->hasMany( WarehouseProduct::class  , 'prd_id' , 'prd_id' );
    }

    //Bill product 1-1 warehouse bill
    public function warehousebill(){
        return $this->belongsTo( WareHouseBill::class , 'wb_id' )->with( [
            'warehouse' => function( $query ){
                $query->select( 'w_id' , 'w_name' , 'w_mobile' , 'groupid' );
            }
        ] )->with( [
            'supplier' => function( $query ){
                $query->select( 'sup_id' , 'sup_name' , 'sup_code' , 'groupid' );
            }
        ] )->with( 'warehouseTransferFrom' )->with( 'warehouseTransferTo' )->with( 'user' );
    }
}
