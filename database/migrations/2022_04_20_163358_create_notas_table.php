<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->float('valor');

            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')
                ->references('id')
                ->on('modulos');

            $table->unsignedBigInteger('inscripcion_id');
            $table->foreign('inscripcion_id')
                ->references('id')
                ->on('inscripciones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
