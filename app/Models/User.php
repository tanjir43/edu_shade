<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'username',
        'phone_number',
        'email',
        'password',
        'email_verified_at',
        'active_status',
        'access_status',
        'language',
        'style_id',
        'rtl_ltl',
        'school_session_id',
        'branch_id',
        'school_id',
        'role_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_administrator',
        'is_registered',
        'verified',
        'random_code',
        'notification_token',
        'device_token',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
