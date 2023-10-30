<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required||exists:employees,id',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'company_id' => 'required|exists:companies,id',
            'email' => [
                'email',
                Rule::unique('employees', 'email')->ignore($this->id), // Игнорируем текущего пользователя
                'max:50',
            ],
            'phone' => 'required|string|max:20|regex:/^[^a-zA-Zа-яА-Я,?!]+$/',
            'note' => 'max:500',
        ];
    }
}
