<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    use HasFactory;
    protected $table = 'cash_account';
    public $timestamps = false;
    protected $primaryKey = 'ca_id';
    protected $fillable = [
        'ca_id' ,
        'ca_code' ,
        'ca_name' ,
        'groupid' ,
    ];
}
