<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidas_resumen_por_provincia', function (Blueprint $table) {
            $table->id();
            $table->integer('provincia_id');
            $table->string('provincia_nombre', 100);
            $table->decimal('media', 10, 2);
            $table->decimal('minimo', 10, 2);
            $table->decimal('maximo', 10, 2);
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
        Schema::dropIfExists('medidas_resumen_por_provincia');
    }
};
