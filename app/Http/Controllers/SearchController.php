<?php

namespace App\Http\Controllers;

use App\Packages;
use App\Excursions;
use App\Cruiseships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller {



    public function show(Request $request) {

      $this->search = '%' . $request->search . '%';

      $excursion = Excursions::select('excursions.id', 'excursions_translation.name', 'excursions_translation.summary', DB::raw("'excursions' as type, 'excursion' as route"));
      $excursion->join('excursions_translation', 'excursions.id', '=', 'excursions_translation.fk_excursion');
      $excursion->where([
        ['is_active', '=', 1],
        ['excursions_translation.fk_language', '=', session('locale')['id']],
      ]);

      $excursion->where(function($excursion){
        $excursion->where('excursions_translation.name', 'like', $this->search)
          ->orWhere('excursions_translation.summary', 'like', $this->search);
      });

      $cruiseship = Cruiseships::select('cruiseships.id', 'cruiseships_translation.name', 'cruiseships_translation.summary', DB::raw("'cruiseships' as type, 'cruise' as route"));
      $cruiseship->join('cruiseships_translation', 'cruiseships.id', '=', 'cruiseships_translation.fk_cruiseship');
      $cruiseship->where([
        ['is_active', '=', 1],
        ['cruiseships_translation.fk_language', '=', session('locale')['id']],
      ]);

      $cruiseship->where(function($cruiseship){
        $cruiseship->where('cruiseships_translation.name', 'like', $this->search)
          ->orWhere('cruiseships_translation.summary', 'like', $this->search);
      });    
      
      $package = Packages::select('packages.id', 'packages_translation.name', 'packages_translation.summary', DB::raw("'packages' as type, 'package' as route"));
      $package->join('packages_translation', 'packages.id', '=', 'packages_translation.fk_package');
      $package->where([
        ['is_active', '=', 1],
        ['packages_translation.fk_language', '=', session('locale')['id']],
      ]);

      $package->where(function($package){
        $package->where('packages_translation.name', 'like', $this->search)
          ->orWhere('packages_translation.summary', 'like', $this->search);
      });
      
      $results = $package->union($excursion)->union($cruiseship)->get();

      return view('front/search/result', compact('results'));
    }    
}