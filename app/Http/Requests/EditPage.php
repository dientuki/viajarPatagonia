<?php

namespace App\Http\Requests;

use App\Translations\Language;
use Illuminate\Foundation\Http\FormRequest;

class EditPage extends FormRequest
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
            $validation['title_' . $language->id] = 'required|string|max:190';
            $validation['slug_' . $language->id] = 'required|string|max:190';
            $validation['body_' . $language->id] = 'required|json';
            $validation['fk_language_' . $language->id] = 'required|in:'.$language->id;
        }

        $validation['is_active'] = 'boolean';
        
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
            $validation['slug_' . $language->id] = __('fields.slug');
            $validation['body_' . $language->id] = __('fields.body');
            $validation['fk_language_' . $language->id] = __('fields.language');
        }

        $validation['is_active'] = __('fields.active');

        return $validation;
    }    
}