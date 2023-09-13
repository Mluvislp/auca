<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateWarehouseBillRequest extends FormRequest {
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
            'w_id'                    => [
                'required' ,
            ] ,
            'wb_type'                 => [
                'required' ,
            ] ,
            'wb_mode'                 => [
                'required' ,
            ] ,
            'sup_id'                  => [
                'required' ,
            ] ,
            'wb_customer_name'        => [
                'nullable'
            ] ,
            'wb_customer_tel'         => [
                'nullable'
            ] ,
            'wb_description'          => [
                'nullable'
            ] ,
            'wb_vat_type'             => [
                'required'
            ] ,
            'wb_vat_value'            => [
                'nullable' ,
                'numeric'
            ] ,
            'wb_tax_bill_code'        => [
                'nullable'
            ] ,
            'wb_manual_discount_type' => [
                'required'
            ] ,
            'wb_manual_discount'      => [
                'nullable' ,
                'numeric'
            ] ,
            'wb_tax_bill_date'        => [
                'nullable'
            ] ,
            'wb_money'                => [
                'nullable' ,
                'numeric'
            ] ,
            'ca_id'                   => [
                'nullable'
            ] ,
            'wb_money_transfer'       => [
                'nullable' ,
                'numeric'
            ] ,
            'ta_id'                   => [
                'nullable'
            ] ,
            'wb_debt_due_date'        => [
                'nullable'
            ] ,
            'product'                 => [] ,
        ];
    }

    public function messages(){
        return [
            'w_id.required'                    => 'Vui lòng chọn kho hàng.' ,
            'wb_mode.required'                 => 'Vui lòng nhập loại đại lý phiếu.' ,
            'wb_type.required'                 => 'Vui lòng nhập kiểu phiếu.' ,
            'sup_id.required'                  => 'Vui lòng nhập nhà cung cấp.' ,
            'wb_vat_type.required'             => 'Kiểu VAT là bắt buộc.' ,
            'wb_vat_value.numeric'             => 'Giá trị VAT phải là chữ số.' ,
            'wb_manual_discount_type.required' => 'Kiểu chiết khấu là bắt buộc.' ,
            'wb_manual_discount.numeric'       => 'Giá trị chiết khấu phải là số.' ,
            'wb_money.numeric'                 => 'Vui lòng nhập tên sản phẩm.' ,
            'wb_money_transfer.numeric'        => 'Vui lòng nhập tên sản phẩm.' ,
        ];
    }
}
