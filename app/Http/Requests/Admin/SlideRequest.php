<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255', // Tiêu đề bắt buộc, kiểu chuỗi, tối đa 255 ký tự
            'image' => $this->isMethod('post') ? 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048' : 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'status' => 'boolean', // Trạng thái phải là true hoặc false
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'image.required' => 'Bạn phải tải lên một hình ảnh.',
            'image.image' => 'File tải lên phải là một hình ảnh.',
            'image.mimes' => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ]; 
    }
}
