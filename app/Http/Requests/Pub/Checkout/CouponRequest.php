<?php

namespace App\Http\Requests\Pub\Checkout;

use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;


class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $response = $this->getMethod();
        if ($response === 'POST') {
            $user = User::query()
                ->where('id', Auth::user()->getAuthIdentifier())
                ->first();
            if ($user->coupons->count() >= 2) {
                return false;
            }
        }
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
            'code' => 'required|exists:coupons|max:255',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ResponseService::sendJsonResponse(false, 400, [
              'Errors' => $validator->errors(),
            ])
        );
    }

}
