<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sprint
 *
 * @property $id
 * @property $nombre
 * @property $fecha_inicio
 * @property $fecha_fin
 * @property $grupo_id
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Grupo $grupo
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sprint extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'grupo_id', 'user_id'];


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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
