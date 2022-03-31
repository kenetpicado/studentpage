<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->string('cedula', 16)->nullable();
            $table->date('fecha_nac');
            $table->string('tel', 8)->nullable();
            $table->string('madre', 45)->nullable();
            $table->string('padre', 45)->nullable();
            $table->string('grado', 45);
            $table->string('carnet', 15)->unique();
            $table->string('pin', 6);
            $table->enum('manual', ['SI', 'NO']);

            //La llave foranea de grupos esta en otra migracion

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
        Schema::dropIfExists('matriculas');
    }
}
