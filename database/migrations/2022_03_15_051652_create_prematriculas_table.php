<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrematriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prematriculas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->string('cedula', 16)->nullable();
            $table->date('fecha_nac');
            $table->date('fecha_prematricula')->default(date('Y-m-d'));
            $table->string('tel', 8)->nullable();
            $table->string('madre', 45)->nullable();
            $table->string('padre', 45)->nullable();
            $table->string('grado', 45);

            //LLAVE FORANEA DEL PROMOTOR QUIEN INSCRIBIÓ
            
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
        Schema::dropIfExists('prematriculas');
    }
}
