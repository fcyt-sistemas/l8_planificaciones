<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('unidad_academica');
            $table->string('codigo',5);
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->string('localidad')->nullable();
            $table->integer('codigo_postal')->nullable();
            $table->string('telefono',30)->nullable();
            $table->string('email', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes');
    }
}
