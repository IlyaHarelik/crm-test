<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:20|regex:/^[^a-zA-Zа-яА-Я,?!]+$/',
            'website' => 'url',
            'note' => 'max:500',
            'logo' => 'image|mimes:jpeg,jpg,png|max:1024',
        ];
    }
}
