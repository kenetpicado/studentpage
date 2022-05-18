<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(strtoupper($value));
    }

    public static function deleteUser($email)
    {
        User::where('email', $email)->first()->delete();
    }

    public static function updateUser($email, $name)
    {
        User::where('email', $email)
            ->first(['id', 'name'])
            ->update(['name' => $name]);
    }
    
    public static function createUser($name, $email, $pin, $rol, $sucursal = 'all')
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($pin),
            'rol' => $rol,
            'sucursal' => $sucursal
        ]);
    }

    public static function getUserByCarnet($model, $email)
    {
        return $model->where('carnet', $email)->first(['id']);
    }
}
