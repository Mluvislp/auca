<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\GroupIdScope;
class WareHouseTranferProduct extends Model
{
    use HasFactory;
    protected $table = 'warehouse_transfer_product';
    public $timestamps = false;
    protected $primaryKey = 'wtp_id';
    protected $fillable = [
        'wtp_id' ,
        'prd_id' ,
        'wtp_price' ,
        'wtp_quantity' ,
        'wtp_discount_type' ,
        'wtp_discount' ,
        'groupid' ,
        'wtp_quantity_defective' ,
    ];
    protected static function boot(){
        parent::boot();
        static::addGlobalScope( new GroupIdScope() );

    }
}
