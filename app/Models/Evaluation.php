<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //

    use HasFactory; 

    protected $fillable = ['docente_id', 'nombre', 'descripcion', 'peso']; 
    
    public function docente() { 
        return $this->belongsTo(User::class); 
    }
}
