<?php

namespace App\Http\Requests;

use App\Models\Producto;
use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }



    public function rules(): array
    {
        //crear un producto (POST)
        $rules = [
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_compra' => 'required|numeric',
            'incremento' => 'required|numeric',
            'id_categoria' => 'required|exists:categorias,id_categoria',
        ];

        //PUT o PATCH (actualizar)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['codigo'] = 'sometimes|string|max:255';
            $rules['nombre'] = 'sometimes|string|max:255';
            $rules['descripcion'] = 'nullable|string';
            $rules['precio_compra'] = 'sometimes|numeric';
            $rules['incremento'] = 'sometimes|numeric';
            $rules['id_categoria'] = 'sometimes|exists:categorias,id_categoria';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'codigo.required' => 'el código del producto es obligatorio.',
            'nombre.required' => 'el nombre del producto es obligatorio.',
            'precio_compra.required' => 'el precio de compra es obligatorio.',
            'incremento.required' => 'el incremento es obligatorio.',
            'id_categoria.required' => 'la categoría del producto es obligatoria.',
            'id_categoria.exists' => 'la categoría seleccionada no existe.',
        ];
    }
}
