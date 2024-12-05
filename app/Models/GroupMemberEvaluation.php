<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMemberEvaluation extends Model
{
    //
    protected $fillable = [
        'evaluation_id',
        'evaluator_id',
        'evaluatee_id',
        'nota',
    ];

    // Relación con Evaluación
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    // Relación con el evaluador
    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    // Relación con el evaluado
    public function evaluatee()
    {
        return $this->belongsTo(User::class, 'evaluatee_id');
    }

}
