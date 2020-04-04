<?php

namespace App\Http\Controllers\Admin;

use App\Pages;
use Exception;
use Illuminate\Http\Request;
use App\Translations\Language;
use App\Http\Requests\StorePage;
use App\Http\Requests\EditPage;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Translations\PagesTranslation;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::getAll();
        $languages = Language::getAll();

        return view('admin/pages/index', compact('pages', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = new Pages();
        $action = 'create';
        $form_data = array('route' => 'admin.pages.store', 'method' => 'POST');

        $languages = Language::getAll();
        
        return view('admin/pages/create', compact('action', 'page',  'form_data', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePage  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePage $request)
    {      
        $data = $request->validated();

        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $data['in_header'] = isset($data['in_header']) ? 1 : 0;
        $data['in_footer'] = isset($data['in_footer']) ? 1 : 0;
        $data['add_contact_form'] = isset($data['add_contact_form']) ? 1 : 0;
        $data['order'] = Pages::getLastOrder() + 1;

        $page = Pages::create($data);

        $this->storeLanguages($page->id, $data);

        return redirect()->route('admin.pages.index');
    }

    private function storeLanguages($id, $data)
    {
        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['fk_language_' . $language->id])) {
                PagesTranslation::create([
                    'fk_language' => $data['fk_language_' . $language->id],
                    'fk_page' => $id,
                    'title' => $data['title_' . $language->id],
                    'slug' => $data['slug_' . $language->id],
                    'body' => $data['body_' . $language->id]
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Pages::find($id);
        $pageTranslation = PagesTranslation::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.pages.update', $page->id), 'method' => 'PATCH');
        $languages = Language::getAll();

        return view('admin/pages/edit', compact('action', 'page', 'form_data', 'languages', 'pageTranslation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditPage  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPage $request, $id)
    {
        $page = Pages::getEdit($id);

        $data = $request->validated();

        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $data['in_header'] = isset($data['in_header']) ? 1 : 0;
        $data['in_footer'] = isset($data['in_footer']) ? 1 : 0;
        $data['add_contact_form'] = isset($data['add_contact_form']) ? 1 : 0;

        $page->fill($data)->save();

        $this->updateLanguages($id, $data);

        return redirect()->route('admin.pages.index');
    }

    private function updateLanguages($id, $data)
    {
        $languages = Language::getAll();
        foreach ($languages as $language) {
            if (isset($data['fk_language_' . $language->id])) {

                $where = array(
                    ['fk_language', $data['fk_language_' . $language->id]],
                    ['fk_page', $id]
                );

                $pageTranslation = PagesTranslation::getUpdate($where);

                $pageTranslation->fill([
                    'title' => $data['title_' . $language->id],
                    'slug' => $data['slug_' . $language->id],
                    'body' => $data['body_' . $language->id]
                ])->save();
            }            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Pages::findOrFail($id);

        try {
            PagesTranslation::where('fk_page', $id)->delete();
            $page->delete();

            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.pages.index');
    }

    public function order(Request $request) {
      $data = json_decode($request->getContent(), true);

      foreach($data as $order) {
        Pages::updateOrder($order['id'], $order['order']);
      }
    }    
}