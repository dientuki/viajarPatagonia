<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCurrency extends FormRequest
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
            'sign' => 'required|string|max:5',
            'code' => 'required|string|max:3',
            'currency' => 'required|string|max:190',
            'amount' => 'required|numeric|between:0,99999999.99'            
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'sign' => __('fields.sign'),
            'code' => __('fields.code'),
            'currency' => __('fields.currency'),
            'amount' => __('fields.amount'),
        ];
    }    
}