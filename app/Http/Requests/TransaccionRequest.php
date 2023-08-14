<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaccionRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'descripcion' => 'required||string|min:5|max:200',
            'monto' => 'required|numeric|min:1|max:999999',
            'fecha' => 'required|date',
            'categoria_id' => 'required|not_in:0',
        ];
    }

    public function messages() {
        return [
            'descripcion.required' => 'El campo Descripción es requerido',
            'descripcion.string' => 'El campo Descripción acepta solamente letras y números',
            'descripcion.min' => 'El valor del campo Descripción tiene un mínimo de 5 caracteres',
            'descripcion.max' => 'El valor del campo Descripción tiene un máximo de 200 caracteres',
            'monto.required' => 'El campo Monto es requerido',
            'monto.numeric' => 'El campo Monto acepta solamente números',
            'monto.min' => 'El Monto debe ser mayor a 1',
            'monto.max' => 'El Monto debe ser menor a 999999',
            'fecha.required' => 'El campo Fecha es requerido',
            'fecha.date' => 'Se aceptan valores de fecha',
            'categoria_id.required' => 'El campo Categoría es requerido',
            'categoria_id.not_in:0' => 'Debe seleccionar una Categoría de la lista',
        ];
    }
}
