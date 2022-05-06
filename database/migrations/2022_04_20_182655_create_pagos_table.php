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
            $table->string('recibo', 10);
            $table->string('concepto', 50);
            $table->enum('tipo', ['1', '0'])->default('1');

            $table->unsignedBigInteger('grupo_matricula_id');
            $table->foreign('grupo_matricula_id')->references('id')->on('grupo_matricula');
            
            $table->timestamps();
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