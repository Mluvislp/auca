<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model {
    use HasFactory;
    public $timestamps = false;

    protected $table = 'warehouse';
    protected $primaryKey = "w_id";
    protected $fillable = [
        'w_id' ,
        'w_name' ,
        'w_mobile' ,
        'w_country_id' ,
        'w_country_iso' ,
        'w_city_id' ,
        'w_city_name' ,
        'w_district_id' ,
        'w_district_name' ,
        'w_ward_id' ,
        'w_ward_name' ,
        'w_address' ,
        'user_id' ,
        'groupid' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GroupIdScope());
        static::deleting(function ($v) {
            $has_v1 = WareHouseBill::where('w_id', $v->w_id)->exists();
            if ($has_v1) {
                throw new \Exception('Không thể xoá kho vì có các mục sử dụng kho này');
            }
            $has_v2 = WarehouseProduct::where('w_id', $v->w_id)->exists();
            if ($has_v2) {
                throw new \Exception('Không thể xoá kho vì có các mục sử dụng kho này');
            }

        });
    }

    const ORDERBY = 'w_name';
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getIdAndName(){
        $data = $this->select('w_id' , 'w_name')->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getById($id){
        $data = $this->where('w_id' , $id)->get();
        return $data;
    }
    public function findFirstById($id){
        $data = $this->where('w_id' , $id)->first();
        return $data;
    }

    //Relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //Warehouse nn-n Product
    public function products(){
        return $this->belongsToMany( Product::class , 'warehouse_product' , 'w_id' , 'prd_id' );
    }
}
