<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:4',
                'max:255',
                'regex:/^[A-Za-z0-9_\-\s]+$/', // will allow letters (both uppercase and lowercase), numbers, underscores, hyphens and spaces in the string.
            ],
            'email' => [
                'required',
                'unique:users,email',
                'email',
            ],
            'address' => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'min:4',
                'max:255',
                'phone', // https://github.com/Propaganistas/Laravel-Phone
            ],
        ];
    }
}
