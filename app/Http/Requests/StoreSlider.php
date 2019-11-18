<?php

namespace App\Http\Requests;

use App\Translations\Language;
use Illuminate\Foundation\Http\FormRequest;

class StoreSlider extends FormRequest
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
            $validation['date_' . $language->id] = 'required';
            $validation['description_' . $language->id] = 'required';
            $validation['fk_language_' . $language->id] = 'required|in:'.$language->id;
        }

        $validation['is_active'] = 'boolean';
        $validation['url'] = 'required';
        $validation['hotel'] = 'required';
        $validation['stars'] = 'required|numeric';      
        $validation['images'] = 'nullable';
        
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
            $validation['title_' . $language->id] = __('fields.title');
            $validation['date_' . $language->id] = __('fields.datr');
            $validation['description_' . $language->id] = __('fields.description');
            $validation['fk_language_' . $language->id] = __('fields.language');
        }

        $validation['is_active'] = __('fields.active');
        $validation['url'] = __('fields.url');
        $validation['hotel'] = __('fields.hotel');
        $validation['stars'] = __('fields.stars');     
        $validation['images[]'] = 'dunno';       

        return $validation;
    }    
}