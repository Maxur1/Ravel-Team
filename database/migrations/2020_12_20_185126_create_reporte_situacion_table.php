<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteSituacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_situacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estudiante_reportado')->unique();
            $table->string('descripcion');
            $table->string('medio_atencion');
            $table->string('asignatura')->nullable();
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
        Schema::dropIfExists('reporte_situacion');
    }
}
