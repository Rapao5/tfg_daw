<?php 

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class IncidenceRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                "ordenador_id" => "integer|min:1",
                "fecha_inicio" => "date",
                "fecha_fin" => "date",
                "status" => "string",
                "resuelto" => "boolean"
            ];
        }

        public function messages(): array
        {
            return [
                'ordenador_id.min' => 'El ordenador seleccionado no es válido.',
                "fecha_inicio.date" => "La fecha de inicio no es válida.",
                "fecha_fin.date" => "La fecha de fin no es válida.",
                "status.string" => "El estado seleccionado no es válido.",
                "resuelto.boolean" => "El valor de resuelto no es válido."
            ];
        }
    }