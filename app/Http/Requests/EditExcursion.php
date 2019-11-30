<?php

namespace App\Http\Requests;

use App\Currency;
use App\Translations\Language;
use Illuminate\Foundation\Http\FormRequest;

class EditExcursion extends FormRequest
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
            $validation['name_' . $language->id] = 'required|string|max:190';
            $validation['summary_' . $language->id] = 'required|string';
            $validation['body_' . $language->id] = 'required|json';
            $validation['fk_language_' . $language->id] = 'required|in:'.$language->id;
        }

        foreach ($currencies as $currency) {
            $validation['price_' . $currency->id] = 'integer|nullable|between:1,16777214';
            $validation['discount_' . $currency->id] = 'integer|nullable|between:1,16777214';
            $validation['is_active_' . $language->id] = 'boolean';
            $validation['fk_currency_' . $currency->id] = 'required|in:'.$currency->id;
        }

        $validation['is_active'] = 'boolean';
        $validation['map'] = 'url|nullable';
        $validation['fk_excursion_type'] = 'required|numeric|exists:excursions_types,id';
        $validation['fk_destination'] = 'required|numeric|exists:destinations,id';
        $validation['fk_availability'] = 'required|numeric|exists:availability,id';
        $validation['fk_duration'] = 'required|numeric|exists:duration,id';           
        $validation['images'] = 'nullable';
        $validation['delete'] = 'nullable';

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
        $currencies = Currency::getAll();
        $validation = [];

        foreach ($languages as $language) {
            $validation['name_' . $language->id] = __('fields.name');
            $validation['summary_' . $language->id] = __('fields.summary');
            $validation['body_' . $language->id] = __('fields.body');
            $validation['fk_language_' . $language->id] = __('fields.language');
        }

        foreach ($currencies as $currency) {
            $validation['price_' . $currency->id] = __('fields.price');
            $validation['discount_' . $currency->id] = __('fields.discount');
            $validation['is_active_' . $language->id] = __('fields.active');
            $validation['fk_currency_' . $currency->id] =  __('fields.currency');
        }        

        $validation['is_active'] = __('fields.active');
        $validation['fk_cruiseship_type'] = __('fields.cruiseshipType');
        $validation['fk_destination'] = __('fields.destination');
        $validation['fk_availability'] = __('fields.availability');
        $validation['fk_duration'] = __('fields.duration');           
        $validation['map'] = __('fields.map');    
        $validation['images[]'] = 'dunno';        

        return $validation;
    }    
}