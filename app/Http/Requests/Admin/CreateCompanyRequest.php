<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:companies|max:50',
            'email' => 'required|email|unique:companies|max:50',
            'phone' => 'required|string|max:20|regex:/^[^a-zA-Zа-яА-Я,?!]+$/',
            'website' => 'url',
            'note' => 'max:500',
            'logo' => 'image|mimes:jpeg,jpg,png|max:1024',
        ];
    }
}
