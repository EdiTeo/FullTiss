<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntregaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'tarea_id' => 'required',
			'grupo_id' => 'required',
			'user_id' => 'required',
			'archivo' => 'required|file|mimes:pdf,doc,docx|max:2048', // Validación para archivos PDF, DOC, y DOCX
        ];
    }
}
