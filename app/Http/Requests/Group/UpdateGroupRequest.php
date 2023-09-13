<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
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
            'group_id' => [
                'required',
            ],
            'group_name' => [
                'required',
            ],
            'tax_code' => [
                'nullable',
            ],
            'phone' => [
                'nullable',
            ],
            'email' => [
                'nullable',
            ],
            'address' => [
                'nullable',
            ],
        ];
    }
    public function messages()
    {
        return [
            'group_id.required' => 'Vui lòng nhập id.',
            'group_name.required' => 'Vui lòng nhập tên.'
        ];
    }
}
