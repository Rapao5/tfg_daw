<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHistoricoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "curso_id" => "required|integer|min:1",
            "aula_id" => "required|integer|min:1"
        ];
    }

    public function messages(): array
    {
        return [
            'curso_id.required' => 'Debe seleccionar un curso.',
            'curso_id.min' => 'El curso seleccionado no es válido.',
            'aula_id.required' => 'Debe seleccionar una aula.',
            'aula_id.min' => 'La aula seleccionada no es válida.'
        ];
    }
}