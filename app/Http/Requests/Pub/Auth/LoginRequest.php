<?php

namespace App\Http\Requests\Pub\Auth;

use App\Services\Response\ResponseService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class LoginRequest extends FormRequest
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
        // alpha_dash ограничит ввод в поле только буквами (большими и маленькими), цифрами, подчеркиваниями и дефисами, но не позволит вводить пробелы и другие специальные символы.
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', // email без пробелов
            ],
            'password' => [
                'required',
                'min:4',
                'max:255',
                'alpha_dash',
            ],
        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            ResponseService::sendJsonResponse(false, 400, [
                'error' => $validator->errors(),
            ])
        );
    }


}
