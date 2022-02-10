<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unidad_academica', 30)->default('FCYT');			
			$table->integer('carrera_id')->unsigned();
			$table->string('nombre', 30);
			$table->tinyInteger('version')->nullable();
			$table->string('nro_resolucion', 100)->nullable();
			$table->tinyInteger('cant_materias')->nullable();
			$table->string('estado', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planes');
    }
}
