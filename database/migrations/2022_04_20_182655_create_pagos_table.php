<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->float('monto');
            $table->string('moneda', 15);
            $table->string('recibo', 20);
            $table->string('concepto', 50);

            $table->unsignedBigInteger('matricula_id');
            $table->foreign('matricula_id')
                ->references('id')
                ->on('matriculas');

            $table->date('created_at')->default(now()->format('Y-m-d'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
