<?php

namespace App\Http\Requests;

use App\Enums\MovimentTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovimentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id', 'uuid'],
            'description' => ['required', 'string', 'min:2', 'max:100'],
            'type'        => ['required', Rule::in(array_keys(MovimentTypeEnum::cases()))],
            'value'       => ['required'],
        ];
    }
}
