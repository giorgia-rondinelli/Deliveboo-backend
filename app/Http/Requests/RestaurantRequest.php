<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:30',
            'address' => 'required|min:5|max:100',
            'p_iva' => 'required|numeric',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome deve essere inserito',
            'name.min' => 'Il nome deve avere almeno :min caratteri',
            'name.max' => 'Il nome deve avere massimo :max caratteri',
            'address.required' => 'L\' indirizzo deve essere inserito',
            'address.min' => 'L\' indirizzo deve avere almeno :min caratteri',
            'address.max' => 'L\' indirizzo deve avere massimo :max caratteri',
            'p_iva.required' => 'La P.IVA deve essere inserita',
            'p_iva.min' => 'La P.IVA deve avere almeno :min caratteri',
            'p_iva.max' => 'La P.IVA deve avere massimo :max caratteri',
            'p_iva.numeric' => 'La P.IVA deve essere un numero',


        ];
    }
}
