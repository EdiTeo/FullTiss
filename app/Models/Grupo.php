<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'docente_id', // Añade esta línea
        'nombre',
        'descripcion',
        'solvencia_tecnica',
        'boleta_garantia',
        'estado',
    ];

    // Define la relación con los usuarios (estudiantes)
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('rol');
    }
    public function docente()
    {
    return $this->belongsTo(User::class, 'docente_id');
    }
    public function tareas() { 
        return $this->belongsToMany(Tarea::class, 'grupo_tarea'); 
    }

    public function usuarios() { 
        return $this->belongsToMany(User::class, 'grupo_user'); 
    }


    public function entregas() { return $this->hasMany(Entrega::class); }
}
