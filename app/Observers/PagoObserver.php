<?php

namespace App\Observers;

use App\Models\Pago;
use Illuminate\Support\Facades\DB;

class PagoObserver
{
    /**
     * Handle the Pago "created" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function created(Pago $pago)
    {
        DB::table('matriculas')->where('id', $pago->matricula_id)->update([
            'activo' => '1',
            'inasistencias' => '0'
        ]);
    }

    /**
     * Handle the Pago "updated" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function updated(Pago $pago)
    {
        //
    }

    /**
     * Handle the Pago "deleted" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function deleted(Pago $pago)
    {
        //
    }

    /**
     * Handle the Pago "restored" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function restored(Pago $pago)
    {
        //
    }

    /**
     * Handle the Pago "force deleted" event.
     *
     * @param  \App\Models\Pago  $pago
     * @return void
     */
    public function forceDeleted(Pago $pago)
    {
        //
    }
}
