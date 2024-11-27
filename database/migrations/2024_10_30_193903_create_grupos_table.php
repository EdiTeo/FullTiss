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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('docente_id')->constrained('users')->onDelete('cascade'); // Relación con el docente
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->boolean('estado')->default(false); // Estado por defecto es false
            $table->string('solvencia_tecnica')->nullable(); // Ruta del PDF
            $table->string('boleta_garantia')->nullable(); // Ruta del PDF
            $table->timestamps();
        });

        // Tabla pivote para la relación muchos a muchos entre grupos y usuarios
        Schema::create('grupo_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('rol'); // Rol en el grupo (Scrum)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_user');
        Schema::dropIfExists('grupos');
    }
};
