<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'variant_category';
    protected $fillable = [
        'cat_id' ,
        'var_id' ,
    ];
    public function createnew( $input ){
        return $this->insertGetId( $input );
    }
    public function getByVarId( $id ){
        $find = $this->where( 'var_id' , $id )->get();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }

}
