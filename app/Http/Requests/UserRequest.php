<?php

namespace App\Http\Requests;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name'     => ['required', 'string', 'min:2', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'max:16'],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'type'     => ['required', Rule::in(array_keys(UserTypeEnum::cases()))],
            'active'   => ['nullable', 'boolean'],
            'roles'    => ['nullable', 'array'],
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'string', 'min:8', 'max:16'];
        }

        return $rules;
    }
}
