<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseRequest extends FormRequest
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
            'w_id' => [
                'required',
            ],
            'w_name' => [
                'required',
            ],
            'w_mobile' => [
                'nullable',
            ],
            'w_address' => [
                'nullable',
            ],
        ];
    }
    public function messages()
    {
        return [
            'w_id.required' => 'Vui lòng nhập id.',
            'w_name.required' => 'Vui lòng nhập tên.'
        ];
    }
}
