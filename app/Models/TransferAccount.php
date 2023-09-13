<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferAccount extends Model
{
    use HasFactory;
    protected $table = 'transfer_account';
    public $timestamps = false;
    protected $primaryKey = 'ta_id';
    protected $fillable = [
        'ta_id' ,
        'ta_code' ,
        'ta_name' ,
        'groupid' ,
    ];
}
