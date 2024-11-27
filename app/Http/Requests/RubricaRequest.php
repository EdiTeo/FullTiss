<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class RubricaRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'titulo' => 'required|string|max:255',
            'criterios' => 'required|array',
            'criterios.*.titulo_criterio' => 'required|string|max:255',
            'criterios.*.peso' => 'required|integer|min:1',
            'criterios.*.descripcion' => 'nullable|string',
            'criterios.*.niveles' => 'required|array',
            'criterios.*.niveles.*.nombre_nivel' => 'required|string|max:255',
            'criterios.*.niveles.*.puntuacion' => 'required|integer',
            'criterios.*.niveles.*.descripcion' => 'nullable|string',
        ];
    }
}
