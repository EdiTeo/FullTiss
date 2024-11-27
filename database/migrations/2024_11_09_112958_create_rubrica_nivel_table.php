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
        Schema::create('rubrica_nivel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criterio_id')->constrained('rubrica_criterio')->onDelete('cascade');
            $table->string('nombre_nivel');//Excelente,Bueno,Malo
            $table->integer('puntuacion');//puntuacion de un nivel en especifico
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubrica_nivel');
    }
};
