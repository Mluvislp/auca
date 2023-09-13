<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogProduct extends Model {
    use HasFactory;

    public    $timestamps = false;
    protected $table      = 'log_product';
    protected $primaryKey = "log_prd_id";
    protected $fillable   = [
        'log_prd_id' ,
        'w_id' ,
        'prd_id' ,
        'log_prd_name' ,
        'log_prd_code' ,
        'log_prd_type' ,
        'log_prd_step' ,
        'log_prd_old_value' ,
        'log_prd_new_value' ,
        'user_id' ,
        'groupid' ,
        'created_at' ,
    ];
    protected $casts      = [
        'log_prd_old_value' => 'json' ,
        'log_prd_new_value' => 'json' ,
    ];
    const ORDERBY = 'created_at';

    const EDIT_PRICE                    = 1;
    const EDIT_IMPORT_PRICE             = 2;
    const HISTORY                       = 3;
    const CHANGE_EDIT_DEFECTIVE_PRODUCT = 4;
    const EDIT_COMBO                    = 5;
    const EDIT_UNIT                     = 6;
    const DELETE_PRODUCT                = 7;

    const STEP_EDIT_PRODUCT                  = 1;
    const STEP_DELETE_PRODUCT                = 2;
    const STEP_DELETE_LINK                   = 3;
    const STEP_ADD_MORE_DEFECTIVE_PRODUCT    = 4;
    const STEP_EDIT_DEFECTIVE_PRODUCT        = 5;
    const STEP_DELETE_MORE_DEFECTIVE_PRODUCT = 6;
    const STEP_EDIT_AMOUNT_WHEN_CREATE_BILL  = 7;
    const STEP_EDIT_NOTE_DEFECTIVE_PRODUCT   = 8;
    const STEP_EDIT_PRICE_BRANCH             = 9;


    protected static function boot(){
        parent::boot();
        static::addGlobalScope( new GroupIdScope() );
    }

    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }

    //log 1 - 1 Product
    public function product(){
        return $this->belongsTo( Product::class , 'prd_id' );
    }

    //log 1 - n User
    public function user(){
        return $this->belongsTo( User::class , 'user_id' );
    }
}
