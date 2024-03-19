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
        Schema::create('interseccion_departamentos_raster', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id');
            $table->foreignId('capa_id')->constrained('capas');
            $table->date('periodo');
            $table->geometry('geom_interseccion');
            // $table->geometry('geom_interseccion', 'MULTIPOLYGON')->srid(4326);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interseccion_departamentos_raster');
    }
};
