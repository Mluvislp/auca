<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierType extends Model
{
    use HasFactory;
    protected $table = 'supplier_type';
    protected $primaryKey = "sup_type_id";
    protected $fillable = [
        'sup_type_id',
        'sup_type_name',
        'groupid'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GroupIdScope());
    }

}
