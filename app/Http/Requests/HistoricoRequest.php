<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoricoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "alumno_id" => "integer|min:1",
            "ordenador_id" => "integer|min:1",
            "curso_id" => "integer|min:1",
            "aula_id" => "integer|min:1"
        ];
    }

    public function messages(): array
    {
        return [
            'alumno_id.min' => 'El alumno seleccionado no es válido.',
            'ordenador_id.min' => 'El ordenador seleccionado no es válido.',
            "curso_id.min" => "El curso seleccionado no es válido.",
            "aula_id.min" => "La aula seleccionada no es válida.",
            "alumno_id.integer" => "El alumno seleccionado no es válido.",
            "ordenador_id.integer" => "El ordenador seleccionado no es válido.",
            "curso_id.integer" => "El curso seleccionado no es válido.",
            "aula_id.integer" => "La aula seleccionada no es válida."
        ];
    }


}