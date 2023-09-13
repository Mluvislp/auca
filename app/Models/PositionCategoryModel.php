<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\GroupIdScope;
class PositionCategoryModel extends Model
{
    use HasFactory;
    public    $timestamps = false;
    protected $table      = 'position_category';
    protected $fillable = [
        'id',
        'name',
        'parent',
        'parent2',
        'warehouse_id',
        'level',
        'created_by',
        'created_at',
    ];
    const DELETE = [null, 0];
    // protected $primaryKey = "prd_id";
    protected static function boot(){
        parent::boot();
        static::addGlobalScope( new GroupIdScope() );
    }

    public function checkExist($id = '',$ware_house = '')
    {
        return self::select($this->fillable)->where('id', $id)->where('warehouse_id', $ware_house)->first();
    }

    public static function ShowOne($id)
    {
        $delete = self::DELETE;

        return self::where(function ($q) use ($delete) {
        })->find($id);
    }
}
