<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Prologue\Alerts\Facades\Alert;

class StoreRegion extends FormRequest
{
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if ($validator->errors()->any()) {
            foreach ($validator->errors()->all() as $error) {
                Alert::error($error)->flash();
            }
        }
    }

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
            'region' => 'required'
        ];
    }
}