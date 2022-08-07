<?php

namespace App\Observers;

use App\Models\Matricula;
use App\Models\User;

class MatriculaObserver
{
    /**
     * Handle the Matricula "created" event.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return void
     */
    public function created(Matricula $matricula)
    {
        User::create([
            'name' => $matricula->nombre,
            'email' => $matricula->carnet,
            'password' => bcrypt($matricula->pin),
            'rol' => 'alumno',
            'sucursal' => $matricula->sucursal,
            'sub_id' => $matricula->id,
        ]);
    }

    /**
     * Handle the Matricula "updated" event.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return void
     */
    public function updated(Matricula $matricula)
    {
        $user = User::where('email', $matricula->carnet)->first();

        if ($user)
            $user->update(['name' => $matricula->nombre]);
    }

    /**
     * Handle the Matricula "deleted" event.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return void
     */
    public function deleted(Matricula $matricula)
    {
        User::where('email', $matricula->carnet)->first()->delete();
    }

    /**
     * Handle the Matricula "restored" event.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return void
     */
    public function restored(Matricula $matricula)
    {
        //
    }

    /**
     * Handle the Matricula "force deleted" event.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return void
     */
    public function forceDeleted(Matricula $matricula)
    {
        //
    }
}
