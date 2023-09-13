<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class BrandModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'brand_parent_id',
        'brand_code',
        'brand_name',
        'brand_order',
        'brand_image',
        'brand_icon',
        'brand_content',
        'brand_description',
        'brand_meta_title',
        'brand_meta_keyword',
        'brand_meta_description',
        'brand_status',
        'created_at' ,
        'updated_at' ,
    ];

    protected $table = 'brand';

    protected $primaryKey = "brand_id";

    protected static function boot()
    {
        parent::boot();

        // Model hook 'deleting' sẽ được kích hoạt trước khi bản ghi bị xóa
        static::deleting(function ($brand) {
            $child1 = Product::where('brand_id',$brand->brand_id)->count();
            if ($child1 > 0) {
                throw new \Exception('vẫn còn product liên kết với bảng ko thể delete.');
            }
        });
    }
    public function getIdAndNameForCombo($id = false){
        if($id){
            $data = $this->select('brand_id' , 'brand_name')->whereNotIn('brand_id', [$id]) ->orderBy( 'brand_name' , 'asc' )->get();
        }else{
            $data = $this->select('brand_id' , 'brand_name')->orderBy( 'brand_name' , 'asc' )->get();
        }
        return $data;
    }
}
