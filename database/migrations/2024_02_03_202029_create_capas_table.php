<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapasTable extends Migration
{
    public function up()
    {
        Schema::create('capas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('resumen');
            $table->foreignId('indice_id')->constrained('indices');
            $table->date('fechaDesde');
            $table->date('fechaHasta')->nullable();
            $table->geometry('geom_capa')->nullable(); // Puedes cambiar el tipo según el tipo de dato GIS que uses
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('capas');
    }
}
