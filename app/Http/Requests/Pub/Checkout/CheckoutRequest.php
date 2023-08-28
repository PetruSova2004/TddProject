<?php

namespace App\Http\Requests\Pub\Checkout;

use App\Rules\Checkout\CountryShouldBeFromDB;
use App\Rules\Checkout\ZipCodeMatchesCountry;
use App\Services\Response\ResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class CheckoutRequest extends FormRequest
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
            'firstname' => 'required|max:255|alpha_dash',
            'lastname' => 'required|max:255|alpha_dash',
            'company' => 'sometimes|required|max:255|alpha_dash', // опциональное поле, но если присутствует, то должно быть обязательным
            'country' => [
                'required',
                new CountryShouldBeFromDB(),
                'max:255',
                'alpha_dash'
            ],
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'price' => 'required|integer',
            'zip' => [
                'required',
                'string',
                new ZipCodeMatchesCountry($this->input('country')),
                'max:255',
                'alpha_dash'
            ],
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', // email и без пробелов
            'notes' => 'nullable|max:255|alpha_dash',
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
