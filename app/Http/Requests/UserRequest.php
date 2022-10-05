<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'matricula' => 'required',
            'nivel' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Favor inserir um nome.',
        'matricula.required' => 'Favor inserir uma matricula.',
        'nivel.required' => 'Favor inserir um nivel.',
        'senha.required' => 'Favor inserir uma senha.',
    ];
}
}
