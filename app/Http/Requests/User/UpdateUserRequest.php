<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required' , 'string', 'max:100'],
            'lastname' => ['required' , 'string', 'max:100'],
            'username' => ['required' , 'string', 'min:6', 'max:15', "unique:users,username,{this->user->id}"],
            'email' => ['required' , 'string', 'email', 'max:100', "unique:users,email,{this->user->email}"],
            'password' => ['nullable', 'string', 'min:8', 'max:15', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no debe exceder los 100 caracteres.',
            'lastname.required' => 'El campo apellido es obligatorio.',
            'lastname.string' => 'El campo apellido debe ser una cadena de texto.',
            'lastname.max' => 'El campo apellido no debe exceder los 100 caracteres.',
            'username.required' => 'El campo nombre de usuario es obligatorio.',
            'username.string' => 'El campo nombre de usuario debe ser una cadena de texto.',
            'username.min' => 'El campo nombre de usuario debe tener al menos 6 caracteres.',
            'username.max' => 'El campo nombre de usuario no debe exceder los 15 caracteres.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'email.required' => 'El campo email es obligatorio.',
            'email.string' => 'El campo email debe ser una cadena de texto.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no debe exceder los 100 caracteres.',
            'email.unique' => 'El email ya está en uso.',
            'password.nullable' => 'El campo contraseña debe ser nulo o una cadena de texto.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'El campo contraseña no debe exceder los 15 caracteres.',
            'password.confirmed' => 'La contraseña no coincide.',
        ];
    }
}
