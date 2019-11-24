<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Inquiry;
use App\Http\Requests\EditInquiry;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;

class InquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiries = Inquiry::getAll();
        return view('admin/inquiries/index', compact('inquiries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inquiry = Inquiry::getEdit($id);
        $inquiry->is_readed = 1;
        $inquiry->save();

        $action    = 'update';
        $form_data = array('route' => array('admin.inquiries.update', $inquiry->id), 'method' => 'PATCH');

        return view('admin/inquiries/form', compact('action', 'inquiry', 'form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditInquiry  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditInquiry $request, $id)
    {
        $inquiry = Inquiry::getEdit($id);

        $data = $request->validated();

        $inquiry->fill($data)->save();

        return redirect()->route('admin.inquiries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        try {
            $inquiry->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.inquiries.index');
    }
}
