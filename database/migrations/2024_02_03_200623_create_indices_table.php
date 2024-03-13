<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicesTable extends Migration
{
    public function up()
    {
        Schema::create('indices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organismo_id')->constrained('organismos');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('color', 7)->nullable(); // Valor Hexadecimal
            $table->enum('frecuencia', ['Semanal', 'Mensual', 'Trimestral', 'Variable']);
            $table->string('escala');
            $table->string('fuente');
            $table->string('link');
            $table->integer('orden')->default(0);
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indices');
    }
}
