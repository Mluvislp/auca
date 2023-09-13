<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Variant extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $table = 'varian';
    protected $primaryKey = "var_id";
    protected $fillable = [
        'var_id' ,
        'vg_id' ,
        'var_parent_id' ,
        'var_name' ,
        'var_code' ,
        'var_type' ,
        'var_unit' ,
        'var_order' ,
        'var_description' ,
        'var_require' ,
        'var_searchable' ,
        'user_id' ,
        'groupid' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at'
    ];

    const ORDERBY = 'var_id';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GroupIdScope());
        static::deleting(function ($variant) {
            $count = VariantCategory::where('var_id', $variant->var_id)->count();
            if ($count > 0) {
                throw new \Exception('Không thể xoá thuộc tính vì có '.$count.' danh mục có thuộc tính này');
            }
            $count2 = VariantValue::where('var_id', $variant->var_id)->count();
            if ($count2 > 0) {
                throw new \Exception('Không thể xoá thuộc tính vì có đang có '.$count2.' giá trị');
            }
            $hasChildren = Variant::where('var_parent_id', $variant->var_id)->exists();
            if ($hasChildren) {
                throw new \Exception('Không thể xoá thuộc tính có chứa thuộc tính con.');
            }
        });
    }

    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }

    public function findFirstById( $id ){
        $find = $this->where( 'var_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }
    public function createnew( $input ){
        return $this->insertGetId( $input );
    }
    public function getIdAndName(){
        $data = $this->select('var_id' , 'var_name')->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getById($id){
        $data = $this->where('var_id' , $id)->first();
        return $data;
    }


    //RELATIONSHIP
    public function children()
    {
        return $this->hasMany(Variant::class, 'var_parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Variant::class, 'var_parent_id');
    }

    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'variant_category');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function variantValues()
    {
        return $this->hasMany(VariantValue::class, 'var_id');
    }
    public function variantCategories()
    {
        return $this->hasMany(VariantCategory::class, 'var_id');
    }
}
