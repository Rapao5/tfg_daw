<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIncidenceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "ordenador_id" => "required|integer|min:1",
            "aula_id" => "required|integer|min:1",
            "curso_id" => "required|integer|min:1",
            "descripcion" => "string",
            "titulo" => "required|string|min:10",
            "disponibilidad" => "boolean"
        ];
    }

    public function messages(): array
    {
        return [
            'ordenador_id.required' => 'Debe seleccionar un ordenador.',
            'ordenador_id.min' => 'El ordenador seleccionado no es válido.',
            'aula_id.required' => 'Debe seleccionar una aula.',
            'aula_id.min' => 'La aula seleccionada no es válida.',
            'curso_id.required' => 'Debe seleccionar un curso.',
            'curso_id.min' => 'El curso seleccionado no es válido.',
            'titulo.required' => 'El título de la incidencia es obligatorio.',
            'titulo.string' => 'El título de la incidencia debe ser un texto.',
            'titulo.min' => 'El título de la incidencia debe tener al menos 10 caracteres.',
            'descripcion.string' => 'La descripción de la incidencia debe ser un texto.',
            'disponibilidad.boolean' => 'La disponibilidad debe ser un valor booleano.'
        ];
    }
}
