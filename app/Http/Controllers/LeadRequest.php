<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50', 'regex:/^(\+7|8)?\s?\(?\d{3}\)?\s?\d{3}[\s\-]?\d{2}[\s\-]?\d{2}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000', ],
            'subject_type' => ['nullable', 'string', 'max:50'],
            'subject_title' => ['nullable', 'string', 'max:255'],
            'agree' => ['accepted'],
           // 'company' => ['nullable', 'size:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Укажите, как к вам обращаться',
            'phone.regex' => 'Укажите телефон в праввильном формате: +79999999999 или 89999999999',
            'phone.required' => 'Укажите телефон для связи',
            'email.email' => 'Проверьте правильность email',
            'agree.accepted' => 'Нужно согласие на обработку персональных данных',
            //'company.size' => 'Заявка не отправлена',
        ];
    }
}
