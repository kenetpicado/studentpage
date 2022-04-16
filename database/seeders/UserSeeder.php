<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin de ch
        User::create([
            'name' => 'ADMIN-CH',
            'email' => 'admin-ch',
            'password' => Hash::make('FFFFFF'),
            'rol' => 'admin',
            'sucursal' => 'CH'
        ]);

        //admin de mg
        User::create([
            'name' => 'ADMIN-MG',
            'email' => 'admin-mg',
            'password' => Hash::make('FFFFFF'),
            'rol' => 'admin',
            'sucursal' => 'MG'
        ]);

        //admin root
        User::create([
            'name' => 'ADMIN',
            'email' => 'root',
            'password' => Hash::make('FFFFFF'),
            'rol' => 'admin',
        ]);
    }
}
