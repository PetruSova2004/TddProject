<?php

namespace App\Http\Requests\Admin\Coupon;

use Illuminate\Foundation\Http\FormRequest;

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
            'code' => [
                'required',
                'min:1',
                'max:255',
                'unique:coupons,code',
                'string',
                'regex:/^[^\s]+$/', // without spaces
            ],
            'discount' => [
                'required',
                'numeric',
                'between:1,50',
            ]
        ];
    }
}
