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
        'product' => 'nullable',
        'id' => 'nullable',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'departure' => 'required',
        'adults' => 'required|integer',
        'childs' => 'integer|nullable',
        'comment' => 'required'
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
      }
      
      return response()->json( array('status' => $status, 'message' => $message) );
    }
}
