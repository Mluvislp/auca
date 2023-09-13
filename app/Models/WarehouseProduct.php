<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class WarehouseProduct extends Model {
    use HasFactory;

    protected $table      = 'warehouse_product';
    protected $primaryKey = "wp_id";
    public $timestamps = false;
    protected $fillable   = [
        'wp_id' ,
        'w_id' ,
        'prd_id' ,
        'wp_quantity' ,
        'wp_quantity_defective' ,
        'groupid' ,
    ];
    protected static function boot(){
        parent::boot();
        static::addGlobalScope( new GroupIdScope() );

    }
    const ORDERBY = 'wp_id';
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function deleteMulti($arr = []){
        if(!empty($arr)){
            $this->whereIn('prd_id', $arr)->delete();
        }
    }
    //Relationship
    //Bill product 1-1 product
    public function product(){
        return $this->belongsTo( Product::class , 'prd_id' );
    }
    //Bill product 1-1 warehouse bill
    public function warehouse(){
        return $this->belongsTo( Warehouse::class , 'w_id' );
    }

    public function GetProductfromwarehouse ($id) {
    	$res =  self::with(['getWareProduct']);
    	return $res->where(function($q)  {

                })->where('w_id', $id)->get();
    }

    public function ShowProductfromwarehouse ($id) {
    	$res =  self::with(['getWareProduct']);
    	return $res->where(function($q)  {

                })->where('wp_id', $id)->first();
    }


    public function getWareProduct()
    {
    	return $this->hasOne(Product::class,'prd_id','prd_id');
    }
}
