<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = "user_id";
    public $timestamps = false;
    protected static $allPermissions = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
         'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
      'email_verified_at' => 'datetime',
    ];

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

        /**
     * The roles user.
     *
     * @var array
     */
    public function Roles()
    {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }
    /**
     * The roles user.
     *
     * @var array
     */
    public function Permissions()
    {
        return $this->hasManyThrough(UserTypeDetail::class, UserType::class, 'id', 'type_id', 'user_type_id');
    }

    public function Check($user)
    {
        return self::where([['email', $user['email']], ['password', md5($user['password'])], ['active', self::ACTIVE]])->first();
    }

    /**
     * Check if user is view_all.
     *
     * @return mixed
     */
    public function isAdmin(): bool
    {
        return $this->isRole('admin');
    }
    /**
     * Check if user is $role.
     *
     * @param string $role
     *
     * @return mixed
     */
    public function isRole(string $role): bool
    {
        return $this->Roles->pluck('type')->contains($role);
    }

    /**
     * Get all permissions of user.
     *
     * @return mixed
     */
    public static function allPermissions()
    {
        if (self::$allPermissions === null) {
            $user = auth()->user();
            self::$allPermissions = $user->Permissions()->get(['page', 'action']);
        }
        return self::$allPermissions;
    }

    public function group(){
        return $this->hasOne(Group::class, 'id', 'groupid');
    }
}
