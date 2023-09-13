<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryInternal extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'category_internal';
    protected $primaryKey = "cat_inter_id";

    protected $fillable = [
        'cat_inter_id',
        'cat_inter_parent_id',
        'cat_inter_name',
        'cat_inter_code',
        'user_id',
        'groupid',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ORDERBY = 'cat_inter_id';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GroupIdScope());
    }
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function findFirstById( $id ){
        $find = $this->where( 'cat_inter_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }
    public function getIdAndName(){
        $data = $this->select('cat_inter_id' , 'cat_inter_name' ,'cat_inter_parent_id')->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getIdAndNameForCombo($id = false){
        if($id){
            $data = $this->select('cat_inter_id' , 'cat_inter_name')->whereNull('cat_inter_parent_id')->whereNotIn('cat_inter_id', [$id]) ->orderBy( self::ORDERBY , 'asc' )->get();
        }else{
            $data = $this->select('cat_inter_id' , 'cat_inter_name')->whereNull('cat_inter_parent_id')->orderBy( self::ORDERBY , 'asc' )->get();
        }
        return $data;
    }
    //RELATIONSHIP
    public function children()
    {
        return $this->hasMany(CategoryInternal::class, 'cat_inter_parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(CategoryInternal::class, 'cat_inter_parent_id');
    }

    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function categoryInternalProduct()
    {
        return $this->hasMany(Product::class, 'cat_inter_id');
    }
}
