<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table      = 'product_type';
    protected $primaryKey = "prd_type_id";
    protected $fillable   = [
        'prd_type_id',
        'prd_type_name',
        'prd_type_active',
    ];

    const ORDERBY = 'prd_type_id';
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getIdAndNameForCombo($id = false){
        if($id){
            $data = $this->select('prd_type_id' , 'prd_type_name')->whereNotIn('prd_type_id', [$id]) ->orderBy( 'prd_type_id' , 'asc' )->get();
        }else{
            $data = $this->select('prd_type_id' , 'prd_type_name')->orderBy( 'prd_type_id' , 'asc' )->get();
        }
        return $data;
    }
}
