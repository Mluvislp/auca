<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model {
    use HasFactory;
    public $timestamps = false;

    protected $table = 'product_detail';
    protected $primaryKey = "pd_id";
    protected $fillable = [
        'pd_id',
        'prd_id',
        'pd_import_price',
        'pd_vat',
        'pd_price',
        'pd_wholesale_price',
        'pd_old_price',
        'pd_shipping_weight',
        'pd_unit',
        'pd_lenght',
        'pd_width',
        'pd_height',
        'pd_image',
        'pd_tag',
        'groupid',
    ];
    public function findFirstById( $id ){
        $find = $this->where( 'pd_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }
    public function findFirstByProductId( $id ){
        $find = $this->where( 'prd_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }
    //relationship
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
