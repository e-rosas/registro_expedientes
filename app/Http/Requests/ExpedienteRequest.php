<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpedienteRequest extends FormRequest
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
            'full_name' => 'required|max:250|min:5',
            'birth_date' => 'date|required',
            'comments' => 'max:500',
            'phone_number' => 'max:255',
            'address' => 'max:255',
            'email' => 'max:180',
            'year' => 'required|numeric',
        ];
    }
}