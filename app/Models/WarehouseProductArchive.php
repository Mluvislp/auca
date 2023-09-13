<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseProductArchive extends Model {
    use HasFactory;

    protected $table      = 'warehouse_product_archive';
    protected $primaryKey = "wpa_id";
    public    $timestamps = false;
    protected $fillable   = [
        'wpa_id' ,
        'prd_id' ,
        'w_id' ,
        'wpa_min' ,
        'wpa_max' ,
        'user_id' ,
        'groupid' ,
        'created_at' ,
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
    public function product()
    {
        return $this->belongsTo(Product::class, 'prd_id' , 'prd_id');
    }
    public function warehouseProduct()
    {
        return $this->belongsTo(WarehouseProduct::class, 'prd_id' , 'prd_id');
    }
}
