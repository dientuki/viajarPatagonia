<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditLanguage extends FormRequest
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
            'language' => 'required|string|max:190',
            'iso' => 'required|string|max:2',
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
            'language' => __('fields.language'),
            'iso' => __('fields.iso'),
        ];
    }    
}