<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:1000',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|exists:users,id',
            'tag_id' => 'required|array|min:1',
            'tag_id.*' => 'integer|exists:tags,id',
        ];
    }
}
