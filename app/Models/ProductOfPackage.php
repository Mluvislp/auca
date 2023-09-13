<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOfPackage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table      = 'product_of_package';
    protected $primaryKey = "pop_id";
    protected $fillable   = [
        'pop_id',
        'prd_id',
        'prd_id_pack	',
        'pop_quantity',
    ];

    public function productDetailOfProductPack(){
        return $this->belongsTo( Product::class , 'prd_id' )
            ->with(['productDetail' => function ($query) {
                $query->select(
                    'pd_id',
                    'prd_id',
                    'pd_import_price',
                    'pd_price',
                );
            }]);
    }
    public function productPack(){
        return $this->belongsTo( Product::class , 'prd_id_pack' );
    }
}
