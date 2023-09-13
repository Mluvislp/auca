<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest {
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
            'prd_name'             => [
                'required' ,
            ] ,
            'prd_type_id'          => [
                'required' ,
            ] ,
            'prd_parent_id'        => [
                'nullable' ,
            ] ,
            'prd_code'             => [
                'nullable' ,
                Rule::unique( 'product' , 'prd_code' ) ,
            ] ,
            'prd_barcode'          => [
                'nullable' ,
                Rule::unique( 'product' , 'prd_barcode' ) ,
            ] ,
            'pd_import_price'      => [
                'nullable' ,
                'numeric' ,
                'integer' ,
                'min:1' ,
                'max:100000000000' ,
            ] ,
            'pd_vat'               => [
                'nullable' ,
                'numeric' ,
                'between:0,200' ,
            ] ,
            'pd_price'             => [
                'nullable' ,
                'numeric' ,
                'integer' ,
                'min:1' ,
                'max:100000000000' ,
            ] ,
            'pd_wholesale_price'   => [
                'nullable' ,
                'numeric' ,
                'integer' ,
                'min:1' ,
                'max:100000000000' ,
            ] ,
            'pd_old_price'         => [
                'nullable' ,
                'numeric' ,
                'integer' ,
                'min:1' ,
                'max:100000000000' ,
            ] ,
            'prd_status_id'        => [
                'nullable' ,
                'integer' ,
            ] ,
            'cat_id'               => [
                'nullable' ,
                'integer' ,
            ] ,
            'cat_inter_id'         => [
                'nullable' ,
                'integer' ,
            ] ,
            'brand_id'             => [
                'nullable' ,
                'integer' ,
            ] ,
            'pd_shipping_weight'   => [
                'nullable' ,
                'numeric' ,
            ] ,
            'pd_unit'              => [
                'nullable' ,
            ] ,
            'pd_lenght'            => [
                'nullable' ,
                'numeric' ,
            ] ,
            'pd_width'             => [
                'nullable' ,
                'numeric' ,
            ] ,
            'pd_height'            => [
                'nullable' ,
                'numeric' ,
            ] ,
            'pd_image'             => [
                'nullable' ,
                'mimetypes:image/jpeg,image/png,image/jpg,image/gif' ,
                'max:2048' ,
            ] ,
            //warranty
            'country_id'           => [
                'nullable' ,
                'integer' ,
            ] ,
            'wa_address'           => [
                'nullable' ,
            ] ,
            'wa_tel'               => [
                'nullable' ,
                'integer' ,
            ] ,
            'wa_num_month'         => [
                'nullable' ,
                'integer' ,
            ] ,
            'wa_content'           => [
                'nullable' ,
            ] ,
            //
            'pd_first_remain'      => [
                'nullable' ,
                'integer' ,
            ] ,
            'w_id'                 => [
                'nullable' ,
                'integer' ,
            ] ,
            'sup_id'               => [
                'nullable' ,
                'integer' ,
            ] ,
            'copy_parent_image'    => [
                'nullable' ,
            ] ,
            'parent_attr'          => [
            ] ,
            'attribute_combinated' => [
            ] ,
        ];
    }

    public function messages(){
        return [
            'prd_name.required'          => 'Vui lòng nhập tên sản phẩm.' ,
            'prd_type_id.required'       => 'Vui lòng chọn loại sản phẩm.' ,
            'prd_code.unique'            => 'Mã sản phẩm đã tồn tại.' ,
            'prd_barcode.unique'         => 'Mã vạch sản phẩm đã tồn tại.' ,
            'pd_import_price.numeric'    => 'Giá nhập khẩu phải là một số.' ,
            'pd_import_price.integer'    => 'Giá nhập khẩu phải là một số nguyên.' ,
            'pd_import_price.min'        => 'Giá nhập khẩu quá nhỏ.' ,
            'pd_import_price.max'        => 'Giá nhập khẩu quá lớn' ,
            'pd_vat.numeric'             => 'VAT không hợp lệ..' ,
            'pd_vat.between'             => 'VAT không hợp lệ.' ,
            'pd_price.numeric'           => 'Giá sản phẩm phải là một số.' ,
            'pd_price.integer'           => 'Giá sản phẩm phải là một số nguyên.' ,
            'pd_price.min'               => 'Giá sản phẩm phải không hợp lệ..' ,
            'pd_price.max'               => 'Giá sản phẩm phải không hợp lệ.' ,
            'pd_wholesale_price.numeric' => 'Giá bán sỉ phải là một số.' ,
            'pd_wholesale_price.integer' => 'Giá bán sỉ phải là một số nguyên.' ,
            'pd_wholesale_price.min'     => 'Giá bán sỉ không hợp lệ.' ,
            'pd_wholesale_price.max'     => 'Giá bán sỉ không hợp lệ.' ,
            'pd_old_price.numeric'       => 'Giá cũ phải là một số.' ,
            'pd_old_price.integer'       => 'Giá cũ phải là một số nguyên.' ,
            'pd_old_price.min'           => 'Giá cũ phải không hợp lệ..' ,
            'pd_old_price.max'           => 'Giá cũ phải không hợp lệ..' ,
            'prd_status_id.integer'      => 'Trạng thái sản phẩm phải là một số nguyên.' ,
            'cat_id.integer'             => 'Danh mục sản phẩm phải là một số nguyên.' ,
            'cat_inter_id.integer'       => 'Danh mục nội bộ phải là một số nguyên.' ,
            'brand_id.integer'           => 'Thương hiệu phải là một số nguyên.' ,
            'pd_shipping_weight.numeric' => 'Trọng lượng vận chuyển phải là một số.' ,
            'pd_lenght.numeric'          => 'Chiều dài phải là một số.' ,
            'pd_width.numeric'           => 'Chiều rộng phải là một số.' ,
            'pd_height.numeric'          => 'Chiều cao phải là một số.' ,
            'pd_image.mimetypes'         => 'Định dạng hình ảnh không được hỗ trợ. Vui lòng chọn định dạng hình ảnh JPG, JPEG, PNG hoặc GIF.' ,
            'pd_image.max'               => 'Kích thước hình ảnh vượt quá giới hạn cho phép.' ,
            'country_id.integer'         => 'Bạn chưa chọn Quốc Gia.' ,
            'wa_tel.integer'             => 'Số điện thoại bảo hành không hợp lệ.' ,
            'wa_num_month.integer'       => 'Số tháng bảo hành phải là một số nguyên.' ,
            'pd_first_remain.integer'    => 'Số lượng tồn kho phải là một số nguyên.' ,
            'sup_id.integer'             => 'Giá trị nhà cung cấp không hợp lệ' ,
            'w_id.integer'               => 'Giá trị cửa hàng không hợp lệ' ,
            'copy_parent_image.integer'  => 'Giá trị của sao chép hình ảnh không hợp lệ' ,
        ];
    }
}