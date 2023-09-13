<?php

namespace App\Http\Requests\Archive;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArchiveRequest extends FormRequest
{
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
            'w_id' => [
                'required' ,
            ] ,
            'prd_id' => [
                'required' ,
            ] ,
            'wpa_min' => [
                'nullable' ,
                'integer' ,
            ] ,
            'wpa_max' =>[
                'nullable' ,
                'integer' ,
            ],
        ];
    }
}
