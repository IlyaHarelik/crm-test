<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'company_id' => 'required||exists:companies,id',
            'email' => 'email|unique:companies|max:50',
            'phone' => 'required|string|max:20|regex:/^[^a-zA-Zа-яА-Я,?!]+$/',
            'note' => 'max:500',
        ];
    }
}
