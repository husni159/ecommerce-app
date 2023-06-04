<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    const TYPE_ADMIN = 'admin';
    const TYPE_EMPLOYEE = 'employee';
    const TYPE_CUSTOMER = 'customer';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getType()
    {
        return $this->type;
    }

    public function isAdmin()
    {
        return $this->type === self::TYPE_ADMIN;
    }

    public function isEmployee()
    {
        return $this->type === self::TYPE_EMPLOYEE;
    }

    public function isCustomer()
    {
        return $this->type === self::TYPE_CUSTOMER;
    }
    public function userId()
    {
        return $this->id;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
