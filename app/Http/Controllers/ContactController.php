<?php

namespace App\Http\Controllers;


use App\Mail\ContactForm;
use Illuminate\Http\Request;
use App\Http\Helpers\Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request) {

      $status = 'error';
      $message = [];
      
      $rules = [

        'fk_language' => 'required|numeric|exists:languages,id',
        'name' => 'required|string',
        'email' => 'required|email',
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
        $this->sendMail($validator->valid());
      }
      
      return response()->json( array('status' => $status, 'message' => $message) );
    }

    private function sendMail($valid) {
      $email = Helpers::getThirdParty('inquiry', false);

      if ($email != false) {
        Mail::to($email)->send(new ContactForm($valid));
      }
    }
}
