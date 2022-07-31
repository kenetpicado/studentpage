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
            $table->string('celular', 8)->nullable();
            $table->string('tutor', 45)->nullable();
            $table->string('grado', 45);
            $table->string('carnet', 15)->unique();
            $table->string('pin', 6);
            $table->string('sucursal', 5);
            $table->boolean('activo')->default('0');

            $table->unsignedBigInteger('promotor_id')->nullable();
            $table->foreign('promotor_id')
                ->references('id')
                ->on('promotors')
                ->onDelete('set null');

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
        Schema::dropIfExists('matriculas');
    }
}
