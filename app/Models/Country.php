<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table      = 'country';
    protected $primaryKey = "country_id";
    protected $fillable   = [
        'country_id',
        'country_iso',
        'country_name',
        'country_nicename',
        'country_iso3',
        'country_numcode',
        'country_phonecode',
    ];
    const ORDERBY = 'country_name';
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getIdAndNameAndCode(){
        $data = $this->select('country_id' , 'country_iso', 'country_nicename')->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function findFirstById($id){
        $data = $this->select('country_iso')->where('country_id' , $id)->first();
        return $data;
    }
}
