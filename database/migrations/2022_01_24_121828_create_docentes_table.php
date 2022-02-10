<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unidad_academica')->nullable();
			$table->string('legajo', 30)->nullable();
			$table->string('tipo_documento')->nullable();
			$table->string('nro_documento', 30)->unique();
			$table->string('apellidos', 200);
			$table->string('nombres', 200);
			$table->integer('sexo')->nullable()->insigned();
			$table->integer('nacionalidad')->nullable()->insigned();
			$table->date('fecha_nacimiento')->nullable();
			$table->string('e-mail', 120)->nullable();
			$table->string('domicilio', 120)->nullable();
			$table->string('localidad')->nullable();
			$table->string('telefono', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes');
    }
}
