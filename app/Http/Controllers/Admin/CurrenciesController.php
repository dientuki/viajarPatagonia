<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Currency;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Http\Requests\EditCurrency;
use App\Http\Requests\StoreCurrency;
use App\Http\Controllers\Controller;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::getAll();
        return view('admin/currencies/index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = new Currency();
        $action = 'create';
        $form_data = array('route' => 'admin.currencies.store', 'method' => 'POST');
        
        return view('admin/currencies/form', compact('action', 'currency',  'form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCurrency  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrency $request)
    {      
        $data = $request->validated();

        $currency = Currency::create($data);

        return redirect()->route('admin.currencies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.currencies.update', $currency->id), 'method' => 'PATCH');

        return view('admin/currencies/form', compact('action', 'currency', 'form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditCurrency  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCurrency $request, $id)
    {
        $currency = Currency::getEdit($id);

        $data = $request->validated();

        $currency->fill($data)->save();

        return redirect()->route('admin.currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);

        try {
            $currency->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.currencies.index');
    }

    public function order(Request $request) {
      $data = json_decode($request->getContent(), true);

      foreach($data as $order) {
        Currency::updateOrder($order['id'], $order['order']);
      }
    }    
}
