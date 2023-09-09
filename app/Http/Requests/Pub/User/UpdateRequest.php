<?php

namespace App\Http\Requests\Pub\User;

use App\Services\Response\ResponseService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class UpdateRequest extends FormRequest
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
                'regex:/^[A-Za-z0-9_\-\s]+$/', // разрешит буквы (как заглавные, так и строчные), цифры, подчеркивания, дефисы и пробелы в строке.
            ],
            'address' => [
                'required',
                'min:4',
                'max:255',
                'regex:/^[A-Za-z0-9_\-\s]+$/'
            ],
            'phone' => [
                'required',
                'string',
                'min:4',
                'max:255',
                'regex:/^\+?\d{1,4}\s?\(?\d{1,4}\)?[\s\.-]?\d{1,10}$/',
                // Регулярное выражение, разрешающее разные форматы номеров:
                // Примеры:
                // +1 (123) 456-7890
                // 123-456-7890
                // 123.456.7890
                // 1234567890
                // +1234 567 890
                'password' => [
                    'nullable',
                    'min:6',
                    'max:255',
                    'confirmed',
                    'alpha_dash',
                ],
            ]
        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            ResponseService::sendJsonResponse(false, 405, [
                'error' => $validator->errors(),
            ])
        );
    }

}
