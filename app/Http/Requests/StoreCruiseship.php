<?php

namespace App\Http\Requests;

use App\Currency;
use App\Translations\Language;
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
        $currencies = Currency::getAll();
        $validation = [];

        foreach ($languages as $language) {
            $validation['name_' . $language->id] = 'required';
            $validation['summary_' . $language->id] = 'required';
            $validation['body_' . $language->id] = 'required';
            $validation['fk_language_' . $language->id] = 'required|in:'.$language->id;
        }

        foreach ($currencies as $currency) {
            $validation['price_' . $currency->id] = 'integer|nullable';
            $validation['discount_' . $currency->id] = 'integer|nullable';
            $validation['is_active' . $language->id] = 'boolean';
            $validation['fk_currency_' . $currency->id] = 'required|in:'.$currency->id;
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
            $validation['name_' . $language->id] = $language->$language;
            $validation['summary_' . $language->id] = $language->$language;
            $validation['body_' . $language->id] = $language->$language;
            $validation['fk_language_' . $language->id] = $language->$language;
        }

        $validation['is_active'] = 'boolean';
        $validation['map'] = 'url';        

        return $validation;
    }    
}