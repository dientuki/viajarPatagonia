<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InquiriesController extends Controller
{
    public function store(Request $request) {

      $status = 'error';
      $message = [];
      
      $rules = [
        'product' => 'required|in:cruise,excursion,package',
        'product_id' => 'required|integer',
        'fk_language' => 'required|numeric|exists:languages,id',
        'name' => 'required|string',
        'email' => 'required',
        'phone' => 'required',
        'departure' => 'required',
        'adults' => 'required|integer',
        'childs' => 'integer|integer|nullable',
        'comment' => 'required|string'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

        foreach ($rules as $field => $validation) {
          if ($validator->errors()->has($field)) {
            $message[$field] = $validator->errors()->first($field);
          }
        }

      } else {
        $status = 'success';
        $message = '';
        Inquiry::create($data);
      }
      
      return response()->json( array('status' => $status, 'message' => $message) );
    }
}
