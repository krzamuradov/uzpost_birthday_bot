<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $memberId = $this->route('member'); // предполагается, что в маршруте: /members/{member}

        return [
            'firstname' => [
                'required',
                'string',
                Rule::unique('members')
                    ->ignore($memberId) // игнорировать текущего
                    ->where(function ($query) {
                        return $query
                            ->where('lastname', $this->lastname)
                            ->where('birthday_at', $this->birthday_at);
                    }),
            ],
            'lastname' => ['required', 'string'],
            'middlename' => ['nullable', 'string'],
            'birthday_at' => ['required', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Заполните поле',
            'unique' => 'Запись с такими данными существует',
        ];
    }
}
