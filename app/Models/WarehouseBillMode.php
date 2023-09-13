<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseBillMode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table      = 'warehouse_bill_mode';
    protected $primaryKey = "wbm_id";
    protected $fillable = [
        'wbm_id',
        'wbm_name',
    ];
    const ORDERBY = 'wbm_id';

    public function getAll(){
        $data = $this->orderBy( self::ORDERBY  , 'desc')->get();
        return $data;
    }
    public function findFirstById($id){
        $data = $this->where('wbm_id' , $id)->first();
        return $data;
    }
}
