<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationProductVariantValue extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table      = 'relation_product_variant_value';
    protected $fillable = [
        'prd_id',
        'vv_id',
    ];
}
