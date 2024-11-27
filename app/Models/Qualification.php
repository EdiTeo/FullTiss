<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    //

    protected $fillable = ['entrega_id', 'user_id', 'entregable_id', 'nota', 'comentarios', 'fecha_calificacion'];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entregable()
    {
        return $this->belongsTo(Entregable::class);
    }

}
