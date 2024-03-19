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
        Schema::create('porcentaje_ocurrencia', function (Blueprint $table) {
            $table->id();
            $table->integer('departamento_id');
            $table->foreignId('capa_id')->constrained('capas');
            $table->date('periodo');
            $table->string('categoria_raster', 100);
            $table->decimal('porcentaje_ocurrencia', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porcentaje_ocurrencia');
    }
};
