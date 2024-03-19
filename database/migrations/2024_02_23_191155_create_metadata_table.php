<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indice_id')->constrained('indices'); //puede ser nullable
            $table->foreignId('capa_id')->constrained('capas'); //puede ser nullable
            $table->enum('presentacion', ['Vectorial', 'Puntos', 'Poligono']);
            $table->enum('frecuencia', ['Semanal', 'Mensual', 'Trimestral', 'Variable']);
            $table->string('escala')->nullable();
            $table->string('fuente')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metadata');
    }
};
