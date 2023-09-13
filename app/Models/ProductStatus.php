<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table      = 'product_status';
    protected $primaryKey = "prd_status_id";
    protected $fillable   = [
        'prd_status_id',
        'prd_status_name',
    ];

    const ORDERBY = 'prd_status_id';
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY , 'asc' )->get();
        return $data;
    }
}
