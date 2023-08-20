<?php

namespace App\Http\Requests\Pub\User;

use App\Services\Response\ResponseService;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'min:4',
                'max:255',
                'alpha_dash',
            ],
            'email' => [
                'email',
                'max:255',
                'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', // email без пробелов
            ],
            'password' => [
                'min:6',
                'max:255',
                'alpha_dash',
            ],
        ];
    }

    protected function failedValidation(\Illuminate\Support\Facades\Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            ResponseService::sendJsonResponse(false, 400, [
                'error' => $validator->errors(),
            ])
        );
    }

}
