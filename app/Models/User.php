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
        $this->attributes['name'] = trim(ucwords(strtolower($value)));
    }

    public static function deleteUser($model, $id)
    {
        $user = $model->find($id);
        User::where('email', $user->carnet)->first()->delete();
        $user->delete();
    }

    public static function updateUser($model, $id, $request)
    {
        $user = $model->find($id);
        $user->update($request->all());

        User::where('email', $user->carnet)
            ->first(['id', 'name'])
            ->update(['name' => $user->nombre]);
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
