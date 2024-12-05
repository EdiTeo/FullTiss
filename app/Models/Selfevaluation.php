<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selfevaluation extends Model
{
    //
    protected $fillable = [
        'evaluation_id',
        'user_id',
        'nota',
    ];

    // Relación con Evaluación
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    // Relación con Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
