<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entrega
 *
 * @property $id
 * @property $tarea_id
 * @property $grupo_id
 * @property $user_id
 * @property $archivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Grupo $grupo
 * @property Tarea $tarea
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Entrega extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tarea_id', 'grupo_id', 'user_id', 'archivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grupo()
    {
        return $this->belongsTo(\App\Models\Grupo::class, 'grupo_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tarea()
    {
        return $this->belongsTo(\App\Models\Tarea::class, 'tarea_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
