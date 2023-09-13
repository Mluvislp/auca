<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationProductTag extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table      = 'relation_product_tag';
    protected $fillable = [
        'prd_id',
        'ptag_id',
    ];
}
