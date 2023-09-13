<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouseBill extends Model {
    use HasFactory;
    protected $table = 'warehouse_bill';
    public $timestamps = false;
    protected $primaryKey = 'wb_id';
    protected $fillable = [
        'wb_id' ,
        'w_id' ,
        'wtrans_id' ,
        'wb_type' ,
        'wb_mode' ,
        'sup_id' ,
        'wb_customer_name' ,
        'wb_wb_customer_tel' ,
        'wb_description' ,
        'wb_manual_discount_type' ,
        'wb_manual_discount' ,
        'wb_money' ,
        'ca_id' ,
        'wb_money_transfer' ,
        'ta_id' ,
        'wb_debt_due_date' ,
        'wb_vat_type' ,
        'wb_vat_value' ,
        'wb_tax_bill_code' ,
        'wb_tax_bill_date' ,
        'wb_from_w' ,
        'wb_to_w' ,
        'user_id' ,
        'groupid' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];
    protected static function boot(){
        parent::boot();
        static::addGlobalScope( new GroupIdScope() );

    }

    //relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function wareHouseBillProduct(){
        return $this->hasMany(WareHouseBillProduct::class , 'wb_id');
    }
    public function warehouseBillMode(){
        return $this->belongsTo(WarehouseBillMode::class , 'wb_mode');
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class , 'w_id');
    }
    public function warehouseTransferFrom(){
        return $this->belongsTo(Warehouse::class , 'wb_from_w');
    }
    public function warehouseTransferTo(){
        return $this->belongsTo(Warehouse::class , 'wb_to_w');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class , 'sup_id');
    }
}
