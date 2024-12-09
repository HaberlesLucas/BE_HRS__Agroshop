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
        // Crear un producto (POST)
        $rules = [
            'codigo'            => 'required|string|max:255',
            'nombre'            => 'required|string|max:255',
            'descripcion'       => 'nullable|string',
            'stock'             => 'required|integer|min:0', //stock >=0
            'stock_min'         => 'nullable|integer|min:0', //stock >=0
            'precio_compra'     => 'required|numeric',
            'incremento'        => 'required|numeric',
            'id_categoria'      => 'required|exists:categorias,id_categoria',
        ];

        // PUT o PATCH (actualizar)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['codigo']        = 'sometimes|string|max:255';
            $rules['nombre']        = 'sometimes|string|max:255';
            $rules['descripcion']   = 'nullable|string';
            $rules['stock']         = 'nullable|integer|min:0';
            $rules['stock_min']     = 'nullable|integer|min:0';
            $rules['precio_compra'] = 'sometimes|numeric';
            $rules['incremento']    = 'sometimes|numeric';
            $rules['id_categoria']  = 'sometimes|exists:categorias,id_categoria';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'codigo.required'           => 'El código del producto es obligatorio.',
            'nombre.required'           => 'El nombre del producto es obligatorio.',
            'precio_compra.required'    => 'El precio de compra es obligatorio.',
            'incremento.required'       => 'El incremento es obligatorio.',
            'id_categoria.required'     => 'La categoría del producto es obligatoria.',
            'id_categoria.exists'       => 'La categoría seleccionada no existe.',
            'stock.required'            => 'El stock del producto es obligatorio.',
            'stock.min'                 => 'El stock debe ser un número entero positivo o cero.',
            'stock_min.min'             => 'El stock mínimo debe ser un número entero positivo o cero.',
        ];
    }
}
