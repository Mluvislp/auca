<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryInternalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cat_inter_parent_id' => [
                'nullable',
                'integer',
            ],
            'cat_inter_name' => [
                'required',
            ],
            'cat_inter_code' => [
                'required',
                Rule::unique('category_internal', 'cat_inter_code')->ignore($this->cat_inter_code, 'cat_inter_code'),
            ],
        ];
    }
    public function messages()
    {
        return [
            'cat_inter_name.required' => 'Vui lòng nhập tên.',
            'cat_inter_code.required' => 'Vui lòng nhập mã.',
            'cat_inter_code.unique' => 'Mã đã tồn tại trong hệ thống.',
            'cat_inter_parent_id.integer' => 'Giá trị phải là số.',
        ];
    }
}
