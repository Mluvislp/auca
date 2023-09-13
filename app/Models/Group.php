<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'table_group';
    protected $primaryKey = "id";
    protected $fillable = [
        'group_name',
        'group_type',
        'callerid',
        'description',
        'tax_code',
        'address',
        'email',
        'phone',
        'fax',
        'website',
        'bank_account_number',
        'bank_name',
        'createby',
        'datecreate',
        'dateupdate',
        'external_hashcode',
        'time_work_id',
        'date_register',
        'date_expired',
        'total_user',
        'active'
    ];
    const ORDERBY = 'id';
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getIdAndName(){
        $data = $this->select('id' , 'group_name')->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
    public function getById($id){
        $data = $this->where('id' , $id)->get();
        return $data;
    }
}
