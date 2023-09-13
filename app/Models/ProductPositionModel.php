<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\GroupIdScope;
class ProductPositionModel extends Model
{
    use HasFactory;
    public    $timestamps = false;
    protected $table      = 'product_position';
    // protected $primaryKey = "prd_id";
    protected static function boot(){
        parent::boot();
        static::addGlobalScope( new GroupIdScope() );
    }
}
