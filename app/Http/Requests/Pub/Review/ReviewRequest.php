<?php

namespace App\Http\Requests\Pub\Review;

use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReviewRequest extends FormRequest
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
        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
        return [
            'product_id' => 'required|exists:products,id|max:255',
            'email' => [
                'required',
                'exists:users,email',
                'email',
                "in:" . $user->email,
                'max:255',
            ],
            'comment' => [
                'string',
                'required',
                'min:4',
                'max:255',
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ResponseService::sendJsonResponse(false, 422, [
               'error' => $validator->errors(),
            ]),
        );
    }

}
