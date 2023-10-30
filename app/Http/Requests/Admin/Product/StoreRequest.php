<?php

namespace App\Http\Requests\Admin\Product;

use App\Models\Category;
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
        $category_ids = Category::query()->pluck('id')->toArray();
        return [
            'title' => [
                'required',
                'min:3',
                'max:255',
            ],
            'description' => [
                'required',
                'min:3',
                'max:255',
            ],
            'price' => [
                'required',
                'regex:/^\d+(\.\d{2})?$/', // The price must be a number with two decimal places
            ],
            'category_id' => [
                'required',
                "in:" . implode(',', $category_ids),
            ],
            'count' => [
                'required',
                'min: 0',
                'numeric',
            ],
            'image_file' => [
                'required',
                'file',
                'mimes:jpg,png,svg,jpeg'
            ],
        ];
    }
}
