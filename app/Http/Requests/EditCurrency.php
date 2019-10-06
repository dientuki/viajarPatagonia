<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Prologue\Alerts\Facades\Alert;

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
            'sign' => 'required|max:5',
            'code' => 'required|max:3',
            'currency' => 'required',
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
            'currency' => 'moneda',
        ];
    }    
}