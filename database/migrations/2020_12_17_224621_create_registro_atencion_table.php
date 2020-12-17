<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroAtencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_atencion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estudiante_atendido')->unique();
            $table->string('descripcion');
            $table->string('medio_atencion');
            $table->string('asignatura');
            $table->string('profesor');
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
        Schema::dropIfExists('registro_atencion');
    }
}
