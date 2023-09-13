<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class FastUploadRequest extends FormRequest
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
            'pd_image' => [
                'nullable' ,
                'mimetypes:image/jpeg,image/png,image/jpg,image/gif' ,
                'max:2048' ,
            ] ,
            'pd_id' =>[
                'required'
            ]
        ];
    }
    public function messages(){
        return [
            'pd_image.mimetypes' => 'Định dạng hình ảnh không được hỗ trợ. Vui lòng chọn định dạng hình ảnh JPG, JPEG, PNG hoặc GIF.',
            'pd_image.max' => 'Kích thước tệp quá lớn vui lòng không vượt quá 2MB.',
            'pd_id.required' => 'Kiểm tra lại giá trị đầu vào.',
        ];
    }
}
