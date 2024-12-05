<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('grupo_id')->constrained()->onDelete('cascade'); 
            $table->date('fecha'); //Fecha de la asistencia
            $table->enum('estado', ['presente', 'retraso', 'ausente_justificado', 'ausente_no_justificado']);
            $table->text('justificacion')->nullable(); //Justificación si es necesaria
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
