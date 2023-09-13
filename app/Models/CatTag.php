<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatTag extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cat_tag';
    protected $primaryKey = "ctag_id";
    protected $fillable = [
        'ctag_id',
        'ctag_name',
        'ctag_color',
        'ctag_text_color',
        'groupid'
    ];
    const ORDERBY = 'ctag_name';
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }

    public function createnew( $input ){
        return $this->insertGetId( $input );
    }
}
