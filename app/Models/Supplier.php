<?php

namespace App\Models;

use App\Models\Scopes\GroupIdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    public $timestamps = false;
    protected $primaryKey = "sup_id";
    protected $fillable = [
        "sup_id",
        "sup_name",
        "sup_code",
        "sup_representative_name",
        "sup_representative_position",
        "sup_representative_mobile",
        "sup_tel",
        "sup_email",
        "sup_address",
        "sup_tax_code",
        "sup_type_id",
        "sup_personal_id",
        "sup_bank_name",
        "sup_bank_branch",
        "sup_bank_account_number",
        "sup_bank_account_holder",
        "sup_note",
        "user_id",
        "groupid",
        "sup_status",
        "created_at",
        "updated_at",
    ];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GroupIdScope());
    }
    public function findFirstById( $id ){
        $find = $this->where( 'sup_id' , $id )->first();
        if( $find ){
            return $find;
        }else{
            return false;
        }
    }
    //Relationship
    public function sup_type()
    {
        return $this->belongsTo(SupplierType::class,'sup_type_id');
    }
    public function product()
    {
        return $this->hasOne(Product::class , 'sup_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
