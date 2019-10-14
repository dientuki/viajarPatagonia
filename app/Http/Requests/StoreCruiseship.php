<?php

namespace App\Http\Requests;

use App\Language;
use Illuminate\Foundation\Http\FormRequest;

class StoreCruiseship extends FormRequest
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
        $languages = Language::getAll();
        $validation = [];

        foreach ($languages as $language) {
            $validation['title_' . $language->id] = 'required';
            $validation['dropline_' . $language->id] = 'required';
            $validation['body_' . $language->id] = 'required';
            $validation['fk_language_' . $language->id] = 'required|in:'.$language->id;
        }

        $validation['is_active'] = 'boolean';
        $validation['map'] = 'url';
        $validation['fk_cruiseship_type'] = 'required|numeric|exists:cruiseships_types,id';
        
        return $validation;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        $languages = Language::getAll();
        $validation = [];

        foreach ($languages as $language) {
            $validation['title_' . $language->id] = $language->$language;
            $validation['dropline_' . $language->id] = $language->$language;
            $validation['body_' . $language->id] = $language->$language;
            $validation['fk_language_' . $language->id] = $language->$language;
        }

        $validation['is_active'] = 'boolean';
        $validation['map'] = 'url';        

        return $validation;
    }    
}