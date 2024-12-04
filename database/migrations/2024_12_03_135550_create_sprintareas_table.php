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
        Schema::create('sprintareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado'])->default('pendiente');
            $table->unsignedInteger('prioridad')->default(1); //Prioridad: 1-Alta, 2-Media, 3-Baja
            $table->foreignId('sprint_id')->constrained()->onDelete('cascade'); //Relación con Sprint
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); //Usuario asignado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sprintareas');
    }
};
