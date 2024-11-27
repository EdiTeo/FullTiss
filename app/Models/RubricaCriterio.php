<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RubricaCriterio extends Model
{
    use HasFactory;
    protected $table = 'rubrica_criterio';

    protected $fillable = ['rubrica_id', 'titulo_criterio', 'peso', 'descripcion'];


    public function rubrica()
    {
        return $this->belongsTo(Rubrica::class);
    }
    public function niveles()
    {
        return $this->hasMany(RubricaNivel::class, 'criterio_id');
    }
}