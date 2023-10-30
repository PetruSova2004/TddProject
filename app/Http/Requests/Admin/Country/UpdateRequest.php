<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $countryId = $this->route('country');
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('countries', 'name')->ignore($countryId)
            ],
            'zip' => [
                'required',
                Rule::unique('countries', 'zip')->ignore($countryId),
                'regex:/^[0-9]{3,6}$/',
            ],
            'code' => [
                'required',
                'string',
                'regex:/^[A-Z]{2}$/',
                Rule::unique('countries', 'code')->ignore($countryId),
            ],
        ];
    }
}
