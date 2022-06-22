<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        $this->attributes['name'] = trim(ucwords(strtolower($value)));
    }

    public static function updateUser($user)
    {
        User::where('email', $user->carnet)
            ->first(['id', 'name'])
            ->update(['name' => $user->nombre]);
    }

    public static function loggedId()
    {
        $user = auth()->user();

        if ($user->rol != 'promotor')
            return 'admin';

        $object = Promotor::where('carnet', $user->email)->first(['id']);
        return $object->id;
    }
}
