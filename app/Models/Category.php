<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'category';
    protected $primaryKey = "cat_id";
    protected $fillable = [
        'cat_id',
        'cat_parent_id',
        'cat_code',
        'cat_name',
        'cat_order',
        'cat_image',
        'cat_icon',
        'cat_content',
        'cat_description',
        'cat_meta_title',
        'cat_meta_keyword',
        'cat_meta_description',
        'cat_status',
        'user_id',
        'groupid',
        'created_at' ,
        'updated_at' ,
        'deleted_at'
    ];
    const ORDERBY = 'cat_id';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GroupIdScope());
        static::deleting(function ($category) {
            $variantCount = VariantCategory::where('cat_id', $category->cat_id)->count();
            if ($variantCount > 0) {
                throw new \Exception('Không thể xoá danh mục vì có '.$variantCount.' thuộc tính thuộc danh mục này');
            }
            $hasChildren = Category::where('cat_parent_id', $category->cat_id)->exists();
            if ($hasChildren) {
                throw new \Exception('Không thể xoá danh mục có chứa danh mục con.');
            }
            if ($category->cat_image) {
                $imagePath = public_path('storage/' . $category->cat_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            if ($category->cat_icon) {
                $iconPath = public_path('storage/' . $category->cat_icon);
                if (file_exists($iconPath)) {
                    unlink($iconPath);
                }
            }
        });
        static::updating(function ($category) {
            if ($category->cat_image && $category->isDirty('cat_image')) {
                $oldImagePath = public_path('storage/' . $category->getOriginal('cat_image'));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            if ($category->cat_icon && $category->isDirty('cat_icon')) {
                $oldIconPath = public_path('storage/' . $category->getOriginal('cat_icon'));
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }
        });
    }
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function findFirstById( $id ){
        $find = $this->where( 'cat_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }
    public function getIdAndName(){
        $data = $this->select('cat_id' , 'cat_name')->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getIdAndNameForCombo($id = false){
        if($id){
            $data = $this->select('cat_id' , 'cat_name')->whereNull('cat_parent_id')->whereNotIn('cat_id', [$id]) ->orderBy( self::ORDERBY , 'asc' )->get();
        }else{
            $data = $this->select('cat_id' , 'cat_name')->whereNull('cat_parent_id')->orderBy( self::ORDERBY , 'asc' )->get();
        }
        return $data;
    }
    //RELATIONSHIP
    public function children()
    {
        return $this->hasMany(Category::class, 'cat_parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'cat_parent_id');
    }
    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function variant()
    {
        return $this->belongsToMany(Variant::class, 'variant_category');
    }
    public function categoryProduct()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }
    public function hasDependentRelationshipsProduct()
    {
        return $this->categoryProduct()->exists();
    }
}
