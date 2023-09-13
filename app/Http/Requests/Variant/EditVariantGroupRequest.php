<?php

namespace App\Http\Requests\Variant;

use Illuminate\Foundation\Http\FormRequest;

class EditVariantGroupRequest extends FormRequest {
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
            'vg_id' => [
                'required' ,
                'integer' ,
            ] ,
            'vg_name' => [
                'required' ,
            ] ,
            'vg_order' => [
                'nullable' ,
                'integer' ,
            ] ,
        ];
    }

    public function messages(){
        return [
            'vg_id.required' => 'Xả ra lỗi khi nhận dữ liệu.' ,
            'vg_id.integer' => 'Xả ra lỗi khi nhận dữ liệu.' ,
            'vg_name.required' => 'Vui lòng nhập tên.' ,
            'vg_order.integer' => 'Thứ tự phải là chữ số' ,
        ];
    }
}
