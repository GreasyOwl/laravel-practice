<?php

namespace App\Http\Requests;

class UpdateCartItem extends APIRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|integer|between:1,10',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => '數量為必填',
            'quantity.integer' => '數量只能是整數',
            'quantity.between' => '數量必須介於 :min 到 :max',
        ];
    }
}
