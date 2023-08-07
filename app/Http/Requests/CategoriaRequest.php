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
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'tipo' => 'required|regex:/^[1-3]+$/|max:10',
        ];
    }

    public function messages() {
        return [
            'required' => 'Campo requerido',
            'nombre.regex' => 'Se aceptan solamente letras y números',
            'tipo.regex' => 'Seleccione una opción válida',
        ];
    }

}
