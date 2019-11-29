<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDestination extends FormRequest
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
            'destination' => 'required|string|max:190',
            'fk_region' => 'required|numeric|exists:regions,id'
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
            'fk_region' => __('fields.region'),
        ];
    }      
}