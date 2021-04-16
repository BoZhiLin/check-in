<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_number',
        'name',
        'gender',
        'id_number',
        'birthday',
        'address',
        'username',
        'password',
        'phone',
        'report_date',
        'leave_date',
        'is_active',
        'remark',
    ];

    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function salary()
    {
        return $this->hasOne(Salary::class);
    }

    public function userChangeLogs()
    {
        return $this->hasMany(UserChangeLog::class);
    }

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

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
}
