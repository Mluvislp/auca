<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantGroup extends Model {
    use HasFactory;
    public $timestamps = false;
    protected $table = 'variant_group';
    protected $primaryKey = "vg_id";
    protected $fillable = [
        'vg_id' ,
        'vg_name' ,
        'vg_order' ,
        'user_id' ,
        'groupid' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];
    const ORDERBY = 'vg_id';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GroupIdScope());
        static::deleting(function ($vg) {
            $count = Variant::where('vg_id', $vg->vg_id)->count();
            if ($count > 0) {
                throw new \Exception('Không thể xoá nhóm thuộc tính vì có '.$count.' thuộc tính thuộc nhóm này');
            }
        });
    }

    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }

    public function createnew( $input ){
        return $this->insertGetId( $input );
    }

    public function findFirstById( $id ){
        $find = $this->where( 'vg_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }
    public function getIdAndName(){
        $data = $this->select('vg_id' , 'vg_name')->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getById($id){
        $data = $this->where('vg_id' , $id)->first();
        return $data;
    }

    //Relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function variant()
    {
        return $this->hasMany(Variant::class, 'vg_id');
    }


}
