<?php

namespace App\Models;

use App\Casts\Ucwords;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'name' => Ucwords::class,
        'email_verified_at' => 'datetime',
    ];

    public static function carnet($carnet)
    {
        return User::where('email', $carnet)->first(['id', 'name', 'password']);
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
