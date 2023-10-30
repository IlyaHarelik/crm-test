<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DestroyEmployeeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:employees,id',
        ];
    }
}
