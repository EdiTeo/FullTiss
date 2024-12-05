<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprintarea extends Model
{
    use HasFactory;

    protected $fillable = [
       'sprint_id', 'nombre', 'descripcion', 'prioridad', 'estado', 'user_id'
    ];

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
