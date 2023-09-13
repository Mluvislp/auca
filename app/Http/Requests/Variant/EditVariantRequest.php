<?php

namespace App\Http\Requests\Variant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditVariantRequest extends FormRequest
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
            'var_id' => [
                'required',
                'integer'
            ],
            'cat_id' => [
                'nullable',
            ],
            'vg_id' => [
                'nullable',
            ],
            'var_parent_id' => [
                'nullable',
            ],
            'var_name' => [
                'required',
            ],
            'var_code' => [
                'required',
                Rule::unique( 'varian' , 'var_code' )->ignore( $this->var_code , 'var_code' ) ,
            ],
            'var_type' => [
                'required',
            ],
            'var_unit' => [
                'nullable',
            ],
            'var_order' => [
                'nullable',
                'integer'
            ],
            'var_description' => [
                'nullable',
            ],
            'var_require' => [
                'nullable',
            ],
            'var_searchable' => [
                'nullable',
            ],
            'holdform'=>[]
        ];
    }
    public function messages()
    {
        return [
            'var_name.required' => 'Vui lòng nhập tên.',
            'var_code.required' => 'Vui lòng nhập mã.',
            'var_code.unique' => 'Mã đã tồn tại trong hệ thống.' ,
            'var_type.required' => 'Giá trị không thể là rỗng',
            'var_order.integer' => 'Giá trị phải là số.',
            'var_id.integer' => 'Có lỗi với dữ liệu.',
            'var_id.required' => 'Có lỗi với dữ liệu.',

        ];
    }}
