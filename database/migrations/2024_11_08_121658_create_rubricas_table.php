<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rubricas', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('tarea_id')->constrained('tareas')->onDelete('cascade');
            $table->foreignId('tarea_id')->nullable()->constrained('tareas')->onDelete('cascade');

            $table->String('titulo'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rubricas');
    }
};
