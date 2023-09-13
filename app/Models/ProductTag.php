<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table      = 'product_tag';
    protected $primaryKey = "ptag_id";
    protected $fillable = [
        'ptag_id',
        'ptag_name',
        'ptag_color',
        'ptag_text_color',
        'groupid',
        'created_at',
        'updated_at',
    ];
    const ORDERBY = 'created_at:asc';
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GroupIdScope());
    }
    public function getAll(){
        $data = $this->orderBy( self::ORDERBY )->get();
        return $data;
    }
    public function getIdAndName(){
        $data = $this->select('ptag_id' , 'ptag_name')->orderBy( self::ORDERBY )->get();
        return $data;
    }
}
