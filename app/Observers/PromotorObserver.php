<?php

namespace App\Observers;

use App\Models\Promotor;
use App\Models\User;

class PromotorObserver
{
    /**
     * Handle the Promotor "created" event.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return void
     */
    public function created(Promotor $promotor)
    {
        $pin = 'FFFFFF';

        User::create([
            'name' => $promotor->nombre,
            'email' => $promotor->carnet,
            'password' => bcrypt($pin),
            'rol' => 'promotor',
            'sucursal' => 'all',
            'sub_id' => $promotor->id,
        ]);

        //Enviar correo
        //event(new SendCredentialsEvent($promotor, $pin));
    }

    /**
     * Handle the Promotor "updated" event.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return void
     */
    public function updated(Promotor $promotor)
    {
        User::where('email', $promotor->carnet)
            ->first()
            ->update([
                'name' => $promotor->nombre
            ]);
    }

    /**
     * Handle the Promotor "deleted" event.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return void
     */
    public function deleted(Promotor $promotor)
    {
        User::where('email', $promotor->carnet)->first()->delete();
    }

    /**
     * Handle the Promotor "restored" event.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return void
     */
    public function restored(Promotor $promotor)
    {
        //
    }

    /**
     * Handle the Promotor "force deleted" event.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return void
     */
    public function forceDeleted(Promotor $promotor)
    {
        //
    }
}
