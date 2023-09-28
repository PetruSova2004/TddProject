<?php

namespace App\Http\Requests\Pub\Auth;

use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterRequest extends FormRequest
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
        // alpha_dash ограничит ввод в поле только буквами (большими и маленькими), цифрами, подчеркиваниями и дефисами, но не позволит вводить пробелы и другие специальные символы.
        return [
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'max:255',
                'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', // email без пробелов
            ],
            'name' => [
                'required',
                'min:4',
                'max:255',
                'regex:/^[a-zA-Z0-9\s\x{00C0}-\x{024F}]+$/u', // разрешить пробелы, и запретить специальные символы, а также разрешает символы из других алфавитов.
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
                'phone', // https://github.com/Propaganistas/Laravel-Phone
            ],
            'password' => [
                'min:4',
                'max:255',
                'alpha_dash',
            ],

        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(
            ResponseService::sendJsonResponse(false, 400, [
                'error' => $validator->errors(),
            ])
        );
    }

}
