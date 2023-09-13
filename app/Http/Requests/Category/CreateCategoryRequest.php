<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){
        return [
            'cat_parent_id' => [
                'nullable' ,
                'integer' ,
                'min:1' ,
            ] ,
            'cat_name' => [
                'required' ,
            ] ,
            'cat_code' => [
                'required' ,
                Rule::unique( 'category' , 'cat_code' ),
            ] ,
            'cat_order' => [
                'nullable',
                'integer' ,
                'min:1' ,
            ] ,
            'cat_image' =>[
                'nullable',
                'mimetypes:image/jpeg,image/png,image/jpg,image/gif',
                'max:2048',
            ],
            'cat_icon' => [
                'nullable',
                'mimetypes:image/jpeg,image/png,image/jpg,image/gif',
                'max:2048',
            ],
            'cat_description' => [
                'nullable' ,
            ] ,
            'cat_status' => [
                'nullable' ,
                'integer' ,
                'min:1' ,
            ] ,
            'cat_tag' => [
                'nullable',
            ],
        ];
    }

    public function messages(){
        return [
            'cat_parent_id.integer' => 'Danh mục cha sai định dạng dữ liệu.',
            'cat_parent_id.min' => 'Id danh mục cha phải là số nguyên dương.',
            'cat_name.required' => 'Vui lòng nhập tên.' ,
            'cat_code.required' => 'Vui lòng nhập mã.' ,
            'cat_code.unique' => 'Mã đã tồn tại trong hệ thống.' ,
            'cat_image.mimetypes' => 'Hình ảnh không đúng định dạng.',
            'cat_icon.mimetypes' => 'Icon không đúng định dạng.',
            'cat_order.integer' => 'Thứ tự phải là số.' ,
            'cat_order.min' => 'Thứ tự là số nguyên dương.',
            'cat_status.integer' => 'Trạng thái sai định dạng dữ liệu.',
            'cat_status.min' => 'Trạng thái sai định dạng dữ liệu.',
        ];
    }
}
