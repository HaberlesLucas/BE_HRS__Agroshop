<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // dd(".");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email|unique:users,email',
            'usuario' => 'required|string|max:255|unique:users,usuario',
            'rol_id' => 'nullable|exists:rols,id_rol',
        ];

        //solicitud de actualización
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['email'] = 'nullable|email|unique:users,email,' . $this->route('id'); //excluyendo al usuario actual
            $rules['usuario'] = 'nullable|string|max:255|unique:users,usuario,' . $this->route('id'); //excluyendo al usuario actual
            $rules['password'] = 'nullable|string|min:6|confirmed';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'rol_id.exists' => 'El rol seleccionado no es válido.',
            'email.unique' => 'El correo electrónico ya está registrado. Por favor, usa otro correo.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide. Por favor, verifica ambas contraseñas.',
        ];
    }
}
