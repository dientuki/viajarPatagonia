<?php

namespace App\Http\Controllers\Admin;

use Exception;

use App\Homeslider;
use Illuminate\Http\Request;
use App\Translations\Language;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditHomeslider;
use App\Http\Requests\CreateHomeslider;
use Spatie\MediaLibrary\Models\Media;
use App\Translations\HomesliderTranslation;

class HomesliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeslider = Homeslider::getAll();
        $languages = Language::getAll();

        return view('admin/homeslider/index', compact('homeslider', 'languages'));
    }

    public function destroy() {}
}