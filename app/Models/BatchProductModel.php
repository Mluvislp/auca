<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchProductModel extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'brand_id',
    //     'brand_parent_id',
    //     'brand_code',
    //     'brand_name',
    //     'brand_order',
    //     'brand_image',
    //     'brand_icon',
    //     'brand_content',
    //     'brand_description',
    //     'brand_meta_title',
    //     'brand_meta_keyword',
    //     'brand_meta_description',
    //     'brand_status',
    //     'created_at' ,
    //     'updated_at' ,
    // ];

    protected $table = 'batch_product';

    protected $primaryKey = "bp_id";
    
    public $timestamps = false;
}
