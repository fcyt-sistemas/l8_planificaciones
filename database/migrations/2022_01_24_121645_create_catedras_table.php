<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatedrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catedras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unidad_academica',30)->nullable();
			$table->string('codigo',30)->nullable();
			$table->string('nombre', 255);
			$table->string('tipo_materia', 5)->nullable();
			$table->string('promovible', 5)->nullable();
			$table->string('req_cursada', 5)->nullable();
			$table->string('permite_libres', 5)->nullable();
			$table->integer('carga_horaria_total')->nullable();
			$table->string('tipo_periodo', 255)->nullable();
			$table->integer('horas_semanales')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catedras');
    }
}
