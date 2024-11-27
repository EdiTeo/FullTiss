<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RubricaNivel extends Model
{
    use HasFactory;
    protected $table = 'rubrica_nivel';

    protected $fillable = ['criterio_id', 'nombre_nivel', 'puntuacion', 'descripcion'];
    public function criterios()
    {
        return $this->belongsTo(RubricaCriterio::class, 'criterio_id');
    }
}