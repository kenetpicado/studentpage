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
            $table->string('carnet', 15)->unique();
            $table->string('pin', 6);
            $table->enum('manual', ['SI', 'NO']);

            //LLAVE FORANEA HACIA PREMATRICULAS
            $table->unsignedBigInteger('prematricula_id')->unique();
            $table->foreign('prematricula_id')->references('id')->on('prematriculas')->onDelete('cascade');
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
