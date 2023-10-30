<?php

namespace App\Http\Requests\Admin\Country;

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
                'string',
                'min:3',
                'max:255',
                'unique:countries,name',
            ],
            'zip' => [
                'required',
                'unique:countries,zip',
                'regex:/^[0-9]{3,6}$/', //  только цифры и иметь длину от 3 до 6 символов
            ],
            'code' => [
                'required',
                'string',
                'regex:/^[A-Z]{2}$/',
                'unique:countries,code',
            ],
        ];
    }
}
