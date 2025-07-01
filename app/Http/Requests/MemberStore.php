<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberStore extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => [
                'required',
                'string',
                Rule::unique('members')->where(function ($query) {
                    return $query
                        ->where('lastname', $this->lastname)
                        ->where('birthday_at', $this->birthday_at);
                }),
            ],
            'lastname' => ['required', 'string'],
            'middlename' => ['nullable', 'string'],
            'birthday_at' => ['required', 'date'],

        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Заполните поле',
            'unique' => "Запись с такими данными существует"
        ];
    }
}
