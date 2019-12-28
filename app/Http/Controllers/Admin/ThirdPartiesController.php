<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\ThirdParties;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditThirdParty;
use App\Http\Requests\StoreThirdParty;

class ThirdPartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thirdParties = ThirdParties::getAll();
        return view('admin/third-parties/index', compact('thirdParties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thirdParty = new ThirdParties();
        $action = 'create';
        $form_data = array('route' => 'admin.third-parties.store', 'method' => 'POST');
        
        return view('admin/third-parties/form', compact('action', 'thirdParty',  'form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreThirdParty  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThirdParty $request)
    {      
        $data = $request->validated();

        $thirdParty = ThirdParties::create($data);

        return redirect()->route('admin.third-parties.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thirdParty = ThirdParties::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.third-parties.update', $thirdParty->id), 'method' => 'PATCH');

        return view('admin/third-parties/form', compact('action', 'thirdParty', 'form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditThirdParty  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditThirdParty $request, $id)
    {
        $thirdParty = ThirdParties::getEdit($id);

        $data = $request->validated();
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;

        $thirdParty->fill($data)->save();

        return redirect()->route('admin.third-parties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thirdParty = ThirdParties::findOrFail($id);

        try {
            $thirdParty->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.third-parties.index');
    }  
}
