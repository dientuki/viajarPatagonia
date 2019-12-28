<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditThirdParty extends FormRequest
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
            'name' => 'required|string|max:190',
            'code' => 'required|string',
            'is_active' => 'boolean',
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
            'name' => __('fields.name'),
            'code' => __('fields.code'),
            'is_active' => __('fields.active')
        ];
    }    
}