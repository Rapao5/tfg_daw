<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class MiniDeleteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "clase_alumno_curso_id" => "required|integer|min:1",
            "clase_id" => "required|integer|min:1",
            "curso_id" => "required|integer|min:1"
        ];
    }

    protected function failedV(Validator $validator)
    {
        throw new HttpResponseException(ApiResponse::error($validator->errors(),"Error en las validaciones",Response::HTTP_PRECONDITION_FAILED));
    }
}
