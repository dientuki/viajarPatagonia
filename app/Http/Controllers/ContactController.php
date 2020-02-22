<?php

namespace App\Http\Controllers;

use App\Mail\CreateContact;
use Illuminate\Http\Request;
use App\Http\Helpers\Helpers;
use App\Http\Requests\StoreContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAvailability  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContact $request)
    {      
        $data = $request->validated();
        
        $this->sendMail($data);

        //return redirect()->route('admin.availability.index');
    }

    private function sendMail($valid) {
      $email = Helpers::getThirdParty('inquiry', false);

      if ($email != false) {
        //Mail::to($email)->send(new CreateContact($valid));
      }
    }
}
