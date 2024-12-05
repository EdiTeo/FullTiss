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
        Schema::create('crossevaluations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('grupo_id')->constrained('grupos')->onDelete('cascade'); // Grupo que califica
                $table->foreignId('grupo_calificado_id')->constrained('grupos')->onDelete('cascade'); // Grupo calificado
                $table->foreignId('evaluation_id')->constrained('evaluations')->onDelete('cascade');// Entregable de la evaluación cruzada
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Integrante que califica
                $table->integer('nota'); // Nota otorgada
                $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crossevaluations');
    }
};
