<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model {
    use HasFactory;

    public    $timestamps = false;
    protected $table      = 'variant_value';
    protected $primaryKey = "vv_id";
    protected $fillable   = [
        'vv_id' ,
        'var_id' ,
        'vv_parent_id' ,
        'vv_name' ,
        'vv_value' ,
        'vv_other_name' ,
        'vv_code' ,
        'vv_other_code' ,
        'vv_unit' ,
        'vv_order' ,
        'user_id' ,
        'groupid' ,
    ];
    const ORDERBY = 'vv_order';

    protected static function boot(){
        parent::boot();

        static::addGlobalScope( new GroupIdScope() );
    }

    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }

    public function createnew( $input ){
        return $this->insertGetId( $input );
    }

    public function findFirstById( $id ){
        $find = $this->where( 'vv_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }

    public function getIdAndName(){
        $data = $this->select( 'vv_id' , 'vv_name' )->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }

    public function getById( $id ){
        $data = $this->where( 'vv_id' , $id )->first();
        return $data;
    }

    //Relationship
    public function variant(){
        return $this->belongsTo( Variant::class , 'var_id' );
    }

    public function user(){
        return $this->belongsTo( User::class , 'user_id' );
    }

    //Parent-child
    public function children(){
        return $this->hasMany( VariantValue::class , 'vv_parent_id' );
    }

    public function parent(){
        return $this->belongsTo( VariantValue::class , 'vv_parent_id' );
    }

    public function recursiveChildren(){
        return $this->children()->with( 'recursiveChildren' );
    }

    //Variant value n-n Product
    public function products(){
        return $this->belongsToMany( Product::class , 'relation_product_variant_value' , 'vv_id' , 'prd_id' );
    }
}
