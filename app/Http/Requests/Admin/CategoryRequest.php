<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    $categoryId = $this->route('id'); // Assuming you pass the category ID in the route

    return [
        'name' => 'required|string|max:255',
        'slug' => [
            'required',
            Rule::unique('service_categories')->ignore($this->route('slug'), 'slug'), // Ignore the current slug
        ],
        'image' => $this->isMethod('post') ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image required only when creating
    ];
}
    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
            'image.required' => 'Ảnh không được để trống .',
            'image.image' => 'File phải là một ảnh hợp lệ.',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Ảnh không được lớn hơn 2 MB.',
        ];
    }
}
