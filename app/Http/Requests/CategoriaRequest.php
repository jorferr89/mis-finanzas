<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array{
        return [
            'nombre' => 'required||string|min:5|max:50',
            'tipo' => 'required|regex:/^[1-3]+$/|max:10',
        ];
    }

    public function messages() {
        return [
            'nombre.required' => 'El campo Nombre es requerido',
            'nombre.string' => 'El campo Nombre acepta solamente letras y números',
            'nombre.min' => 'El valor del campo Nombre tiene un mínimo de 5 caracteres',
            'nombre.max' => 'El valor del campo Nombre tiene un máximo de 50 caracteres',
            'tipo.required' => 'El campo Tipo es requerido',
            'tipo.regex' => 'Valor inválido para el campo Tipo',
            'tipo.max' => 'El valor del campo Tipo tiene un máximo de 10 caracteres',
        ];
    }

}
