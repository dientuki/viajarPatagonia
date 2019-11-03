<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InquiriesController extends Controller
{
    public function store(Request $request) {

      $validator = Validator::make($request->all(), [
        'product' => 'nullable',
        'id' => 'nullable',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'departure' => 'required',
        'adults' => 'required|integer',
        'childs' => 'integer|nullable',
        'comment' => 'required'
      ]);

      if ($validator->fails()) {
        return view('front/forms/inquiries')->withErrors($validator)->render();
      }
      
      return response()->json( array('success' => true));
    }
}
