<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'El campo categoría es obligatorio.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',
            'product_image.required' => 'El campo imagen del producto es obligatorio.',
            'product_image.image' => 'El archivo debe ser una imagen.',
            'product_image.mimes' => 'El archivo debe ser una imagen en formato JPEG, PNG, JPG o GIF.',
            'product_image.max' => 'El tamaño máximo del archivo de imagen es de 2MB.',
            'product_name.required' => 'El campo nombre del producto es obligatorio.',
            'product_name.string' => 'El campo nombre del producto debe ser una cadena de caracteres.',
            'product_name.max' => 'El campo nombre del producto no puede exceder los 255 caracteres.',
            'product_description.required' => 'El campo descripción del producto es obligatorio.',
            'product_description.string' => 'El campo descripción del producto debe ser una cadena de caracteres.',
            'product_price.required' => 'El campo precio del producto es obligatorio.',
            'product_price.numeric' => 'El campo precio del producto debe ser un número.',
            'product_price.min' => 'El campo precio del producto debe ser igual o mayor a cero.',
            'product_stock.required' => 'El campo stock del producto es obligatorio.',
            'product_stock.integer' => 'El campo stock del producto debe ser un número entero.',
            'product_stock.min' => 'El campo stock del producto debe ser igual o mayor a cero.',
        ];
    }
}
