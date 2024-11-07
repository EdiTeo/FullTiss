<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarea
 *
 * @property $id
 * @property $entregable_id
 * @property $docente_id
 * @property $nombre
 * @property $descripcion
 * @property $peso
 * @property $fecha_inicio
 * @property $fecha_limite
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Entregable $entregable
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tarea extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['entregable_id', 'docente_id', 'nombre', 'descripcion', 'peso', 'fecha_inicio', 'fecha_limite'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'docente_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entregable()
    {
        return $this->belongsTo(\App\Models\Entregable::class, 'entregable_id', 'id');
    }

    public function grupos() { 
        return $this->belongsToMany(Grupo::class, 'grupo_tarea'); 
    }
    
}
