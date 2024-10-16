<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ServieRequest extends FormRequest
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
        $slugRule = Rule::unique('services');
        return [
            'name' => 'required|string|max:255',
            'slug' => $this->isMethod('post') 
            ? $slugRule 
            : $slugRule-> ignore($this->slug, 'slug'),
            'featured'=> 'required|boolean',
            'tagline' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'discount_type' => 'nullable|string|in:fixed,percent',
            'description' => 'required|string',
            'inclusion' => 'nullable|string',
            'exclusion' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => $this->isMethod('post') ? 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048' : 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'thumbnail' => $this->isMethod('post') ? 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048' : 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên dịch vụ là bắt buộc.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.unique' => 'Slug này đã tồn tại.',
            'tagline.required' => 'tagline là bắt buộc.',
            'price.required' => 'Giá dịch vụ là bắt buộc.',
            'description.required' => 'Mô tả là bắt buộc.',
            'price.numeric' => 'Giá phải là một số hợp lệ.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'featured.required' => 'Nổi bật là bắt buộc.',
            'status.boolean' => 'Trạng thái phải là true hoặc false.',
            'image.required' => 'Ảnh là bắt buộc.',
            'image.image' => 'Tệp phải là một hình ảnh hợp lệ.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpg, png, jpeg, gif, svg.',
            'image.max' => 'Kích thước tệp hình ảnh không được vượt quá 2MB.',
            'thumbnail.required' => 'Ảnh thu nhỏ là bắt buộc.',
            'thumbnail.image' => 'Tệp ảnh thu nhỏ phải là một hình ảnh hợp lệ.',
            'thumbnail.mimes' => 'Ảnh thu nhỏ phải có định dạng: jpg, png, jpeg, gif, svg.',
            'thumbnail.max' => 'Kích thước tệp ảnh thu nhỏ không được vượt quá 2MB.',
        ];
    }
}
