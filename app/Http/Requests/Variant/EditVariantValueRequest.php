<?php

namespace App\Http\Requests\Variant;

use App\Models\VariantValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditVariantValueRequest extends FormRequest
{
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
            'vv_id' => [
                'required' ,
                'integer' ,
            ] ,
            'vv_name' => [
                'required' ,
            ] ,
            'var_id' => [
                'required' ,
                'integer' ,
            ] ,
            'vv_parent_id' => [
                'nullable' ,
                'integer' ,
            ] ,
            'vv_value' => [
                'nullable' ,
            ] ,
            'vv_other_name' => [
                'nullable' ,
            ] ,
            'vv_code' => [
                'nullable' ,
                Rule::unique( (new VariantValue() )->getTable() , 'vv_code' )->ignore( $this->vv_code , 'vv_code' ) ,
            ] ,
            'vv_other_code' => [
                'nullable' ,
            ] ,
            'vv_unit' => [
                'nullable' ,
            ] ,
            'vv_order' => [
                'nullable' ,
                'integer' ,
            ] ,
        ];
    }

    public function messages(){
        return [
            'vv_name.required' => 'Vui lòng nhập tên' ,
            'var_id.required' => 'Lỗi giá trị đầu vào' ,
            'vv_id.required' => 'Lỗi giá trị đầu vào' ,
            'vv_code.unique' => 'Mã đã tồn tại trong hệ thống.' ,
            'var_id.integer' => 'Lỗi giá trị đầu vào' ,
            'vv_id.integer' => 'Lỗi giá trị đầu vào' ,
            'vv_parent_id.integer' => 'Giá trị của giá trị cha không đúng' ,
            'vv_order.integer' => 'Thứ tự phải là số' ,
        ];
    }
}
