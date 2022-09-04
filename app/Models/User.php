<?php

namespace App\Models;

use App\Casts\Ucwords;
use App\Models\Permiso;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'rol', 'sucursal', 'sub_id'];
    public $timestamps = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'name' => Ucwords::class,
        'email_verified_at' => 'datetime',
    ];

    public static function docentes()
    {
        return User::with('permisos')
            ->where('rol', 'docente')
            ->when(auth()->user()->sucursal != 'all', function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->get(['id', 'email', 'name']);
    }

    public static function promotores()
    {
        return User::with('permisos')
            ->where('rol', 'promotor')
            ->get(['id', 'email', 'name']);
    }

    public function permisos()
    {
        return $this->hasMany(Permiso::class);
    }
}
