<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\GroupIdScope;
class WareHouseTranfer extends Model
{
    use HasFactory;
    protected $table = 'warehouse_transfer';
    public $timestamps = false;
    protected $primaryKey = 'wtrans_id';
    protected $fillable = [
        'wtrans_id' ,
        'wtrans_from_w_id' ,
        'wtrans_to_w_id' ,
        'wtrans_tag' ,
        'wtrans_status' ,
        'wtrans_description' ,
        'wb_wb_customer_tel' ,
        'wb_description' ,
        'wtrans_file' ,
        'groupid' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];
    protected static function boot(){
        parent::boot();
        static::addGlobalScope( new GroupIdScope() );

    }
}
