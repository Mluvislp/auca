<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    public    $timestamps = false;
    protected $table      = 'product';
    protected $primaryKey = "prd_id";
    protected $fillable   = [
        'prd_id' ,
        'prd_name' ,
       // 'prd_extend_name' ,
        'prd_type_id' ,
        'prd_parent_id' ,
        'prd_code' ,
       // 'prd_extend_code' ,
        'prd_barcode' ,
        'prd_imei' ,
        'prd_status_id' ,
        'cat_id' ,
        'cat_inter_id' ,
        'brand_id' ,
        'sup_id' ,
        'groupid' ,
        'user_id' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];
    const ORDERBY = 'prd_id';

    protected static function boot(){
        parent::boot();
        static::addGlobalScope( new GroupIdScope() );
        static::deleting( function( $product ){
            $hasChildren = Product::where( 'prd_parent_id' , $product->prd_id )->exists();
            if( $hasChildren ){
                throw new \Exception( 'Không thể xoá sản phẩm vì có chứa sản phẩm con.' );
            }
            $hasBillWareHouse = WareHouseBillProduct::where( 'prd_id' , $product->prd_id )->exists();
            if( $hasBillWareHouse ){
                throw new \Exception( 'Không thể xoá sản phẩm vì tồn tại trong kho.' );
            }
            ProductOfPackage::where( 'prd_id_pack' , $product->prd_id )->delete();
        } );
    }

    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }

    public function getIdAndName(){
        $data = $this->select( 'prd_id' , 'prd_name' )->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }

    public function findFirstById( $id ){
        $find = $this->where( 'prd_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }

    //RELATIONSHIP
    //Parent - children
    public function children(){
        return $this->hasMany( Product::class , 'prd_parent_id' );
    }

    public function parent(){
        return $this->belongsTo( Product::class , 'prd_parent_id' );
    }

    public function recursiveChildren(){
        return $this->children()->with( 'recursiveChildren' );
    }

    //Product 1 - 1 Product detail
    public function productDetail(){
        return $this->hasOne( ProductDetail::class , 'prd_id' );
    }

    //Product 1 - n Category
    public function categories(){
        return $this->belongsTo( Category::class , 'cat_id' );
    }
    //Product 1 - n Category
    public function categoryInternal(){
        return $this->belongsTo( CategoryInternal::class , 'cat_inter_id' );
    }

    //Product 1 - n User
    public function user(){
        return $this->belongsTo( User::class , 'user_id' );
    }

    //Product n-n Variant value
    public function variants(){
        return $this->belongsToMany( Variant::class , 'relation_product_variant_value' , 'prd_id' , 'var_id' );
    }

    public function variantValues(){
        return $this->belongsToMany( VariantValue::class , 'relation_product_variant_value' , 'prd_id' , 'vv_id' )->with( [
                'variant' => function( $query ){
                    $query->select( 'var_id' , 'vg_id' , 'var_parent_id' , 'var_name' , 'var_code' , 'var_type' , 'var_unit' , 'var_description' , 'var_require' , 'var_require' , );
                }
            ] );
    }

    //supplier 1-1
    public function supplier(){
        return $this->belongsTo( Supplier::class , 'sup_id' );
    }
    //brand 1-1
    public function brand(){
        return $this->belongsTo( BrandModel::class , 'brand_id' );
    }
    //supplier 1-1
    public function type(){
        return $this->belongsTo( ProductType::class , 'prd_type_id' );
    }
    //supplier 1-1
    public function warranty(){
        return $this->hasOne( Warranty::class ,'prd_id' );
    }

    //Product 1 - n Log product
    public function logProduct(){
        return $this->hasMany( LogProduct::class  );
    }
    //Product n-n Warehouse
    public function warehouse(){
        return $this->belongsToMany( Warehouse::class , 'warehouse_product' , 'prd_id' , 'w_id' );
    }
    //Product n-n Warehouse
    public function warehouseWithPivot(){
        return $this->belongsToMany( Warehouse::class )->withPivot('wp_id','w_id','prd_id','wp_quantity','wp_quantity_defective');
    }
    //Product 1-n Warehouse Product
    public function warehouseProduct(){
        return $this->hasMany( WarehouseProduct::class , 'prd_id'  );
    }
    //Product 1-n product pack
    public function productOfPack(){
        return $this->hasMany( ProductOfPackage::class , 'prd_id_pack' , 'prd_id'  )
            ->with(['productDetailOfProductPack' => function ($query) {
                $query->select(
                    'prd_id',
                    'prd_name',
                );
            }]);
    }
}
