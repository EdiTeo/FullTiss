<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
<<<<<<< HEAD
    protected $fillable = ['user_id', 'grupo_id', 'fecha', 'presentado', 'pendiente'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
=======
    use HasFactory;

    protected $fillable = [
         
        'presentado',
        'pendiente',
        'fecha',
        'grupo_id', 
        'user_id'
    ];

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
>>>>>>> 6cabe515b7fe6d0ccd6964b0b1f151e9d8d288e9
    }

}
