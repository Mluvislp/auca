<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTag extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'category_tag';
    protected $fillable = [
        'cat_id' ,
        'ctag_id' ,
    ];
    public function createnew( $input ){
        return $this->insertGetId( $input );
    }
    public function getByCatId( $id ){
        $find = $this->where( 'cat_id' , $id )->get();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }
    public function deleteByCatId($id)
    {
        $deletedRows = $this->where('cat_id', $id)->delete();

        if ($deletedRows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
