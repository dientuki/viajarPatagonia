<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditInquiry extends FormRequest
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
          'name' => 'required',
          'email' => 'required',         
          'phone' => 'required',
          'departure' => 'required',
          'adult' => 'required|integer',
          'child' => 'required|integer',
          'comment' => 'required'             
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
        'email' => __('fields.email'),         
        'phone' => __('fields.phone'),
        'departure' => __('fields.departure'),
        'adult' => __('fields.adult'),
        'child' => __('fields.child'),
        'comment' => __('fields.comment')             
      ];      
    }    
}