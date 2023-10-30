<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DestroyCompanyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:companies,id',
        ];
    }
}
