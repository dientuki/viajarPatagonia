<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\EditUser;
use App\Http\Requests\StoreUser;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::getAll();
      return view('admin/users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $action = 'create';
        $form_data = array('route' => 'admin.users.store', 'method' => 'POST');
        
        return view('admin/users/form', compact('action', 'user',  'form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {      
        $data = $request->validated();

        $user = User::create($data);
        // send mail
        //$token = Password::getRepository()->create($user);
        //$user->sendPasswordResetNotification($token);        

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.users.update', $user->id), 'method' => 'PATCH');

        return view('admin/users/form', compact('action', 'user', 'form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditUser  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUser $request, $id)
    {
        $user = User::getEdit($id);

        $data = $request->validated();

        $user->fill($data)->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.users.index');
    }
}
