<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class CreatePackageRequest extends FormRequest {
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
            'w_id'              => [
                'required' ,
            ] ,
            'pack_name'         => [
                'required' ,
            ] ,
            'pack_code'         => [
                'nullable' ,
            ] ,
            'pack_note'         => [
                'nullable' ,
            ] ,
            'pack_quantity'     => [
                'required'
            ] ,
            'cat_id'            => [
                'nullable'
            ] ,
            'pack_import_price' => [
                'nullable'
            ] ,
            'product'           => [] ,
        ];
    }

    public function messages(){
        return [
            'w_id.required'                    => 'Vui lòng chọn kho hàng.' ,
            'pack_name.required'                 => 'Vui lòng nhập loại đại lý phiếu.' ,
            'pack_quantity.required'                 => 'Vui lòng nhập kiểu phiếu.' ,
        ];
    }
}
