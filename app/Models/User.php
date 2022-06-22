<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    //Actualizar usuario
    public static function updateUser($user)
    {
        User::where('email', $user->carnet)
            ->first(['id', 'name'])
            ->update(['name' => $user->nombre]);
    }

    //Crear un nuevo usuario
    public static function createUser($request, $sub_id, $pin, $rol)
    {
        User::create([
            'name' => $request->nombre,
            'email' => $request->id,
            'password' => Hash::make($pin),
            'rol' => $rol,
            'sucursal' => $request->sucursal,
        ]);
    }

    public static function loggedId($model)
    {
        $user = auth()->user();

        if ($user->rol != 'promotor')
            return 'admin';

        $object = $model->where('carnet', $user->email)->first(['id']);
        return $object->id;
    }
}
