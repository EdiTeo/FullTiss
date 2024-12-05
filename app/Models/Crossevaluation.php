<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crossevaluation extends Model
{
    //
    use HasFactory;

    protected $fillable = ['grupo_id', 'grupo_calificado_id', 'evaluation_id', 'user_id', 'nota'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function grupoCalificado()
    {
        return $this->belongsTo(Grupo::class, 'grupo_calificado_id');
    }

    public function evaluation() { 
        return $this->belongsTo(Evaluation::class); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarea() { 
        return $this->belongsTo(Tarea::class); 
    }


}
