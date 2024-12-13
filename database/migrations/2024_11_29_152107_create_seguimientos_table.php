<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientosTable extends Migration
{
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario que crea el seguimiento
            $table->foreignId('grupo_id')->constrained()->onDelete('cascade'); // Relación con el grupo
            $table->date('fecha');
            $table->text('presentado');
            $table->text('pendiente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seguimientos');
    }
}
