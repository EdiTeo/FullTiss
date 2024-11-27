<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrica extends Model
{
    use HasFactory;
    protected $fillable = ['tarea_id', 'titulo'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }
    public function criterios()
    {
        return $this->hasMany(RubricaCriterio::class);
    }
}
