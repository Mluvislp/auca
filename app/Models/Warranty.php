<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table      = 'warranty';
    protected $primaryKey = "wa_id";
    protected $fillable   = [
        'wa_id',
        'prd_id',
        'country_iso',
        'country_id',
        'wa_address',
        'wa_tel',
        'wa_num_month',
        'wa_content',
        'groupid',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    const ORDERBY = 'wa_id';
    public function findFirstByProduct($id){
        $data = $this->where('prd_id' , $id)->first();
        return $data;
    }
    public function getIdAndNameAndCode(){
        $data = $this->select('country_id' , 'country_iso', 'country_nicename')->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    //
    public function country(){
        return $this->hasOne(Country::class , 'country_id','country_id');
    }
    //warranty 1-1
    public function product(){
        return $this->belongsTo( Product::class , 'prd_id');
    }

}
