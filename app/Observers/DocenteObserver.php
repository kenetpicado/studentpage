<?php

namespace App\Observers;

use App\Events\SendCredentialsEvent;
use App\Models\Docente;
use App\Models\User;

class DocenteObserver
{
    /**
     * Handle the Docente "created" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function created(Docente $docente)
    {
        $pin = 'FFFFFF';

        User::create([
            'name' => $docente->nombre,
            'email' => $docente->carnet,
            'password' => bcrypt($pin),
            'rol' => 'docente',
            'sucursal' => $docente->sucursal,
            'sub_id' => $docente->id,
        ]);

        //Enviar correo
        //event(new SendCredentialsEvent($docente, $pin));
    }

    /**
     * Handle the Docente "updated" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function updated(Docente $docente)
    {
        User::where('email', $docente->carnet)
            ->first()
            ->update([
                'name' => $docente->nombre
            ]);
    }

    /**
     * Handle the Docente "deleted" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function deleted(Docente $docente)
    {
        User::where('email', $docente->carnet)->first()->delete();
    }

    /**
     * Handle the Docente "restored" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function restored(Docente $docente)
    {
        //
    }

    /**
     * Handle the Docente "force deleted" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function forceDeleted(Docente $docente)
    {
        //
    }
}
