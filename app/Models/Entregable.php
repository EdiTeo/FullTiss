<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entregable
 *
 * @property $id
 * @property $docente_id
 * @property $nombre
 * @property $descripcion
 * @property $peso
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Entregable extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['docente_id', 'nombre', 'descripcion', 'peso'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'docente_id', 'id');
    }

    public function tareas() { 
        return $this->hasMany(Tarea::class); 
    }
    
    public function crossevaluations() { 
        return $this->hasMany(Crossevaluation::class); 
    }
    public function docente() { return $this->belongsTo(User::class, 'docente_id'); }
}
