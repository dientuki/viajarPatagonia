<?php

namespace App\Http\Helpers;

use Request;
use App\Pages;
use App\Inquiry;
use App\Packages;
use App\Excursions;
use App\Cruiseships;
use App\ThirdParties;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Translations\PagesTranslation;
use App\Translations\PackageTranslation;
use App\Translations\ExcursionsTranslation;
use App\Translations\CruiseshipsTranslation;

class Helpers {
  public static function load_resource($resource, $url = true) {
    $manifest = file_get_contents(public_path('/dist/manifest.json'));

    if ($manifest == false) {
      return false;
    }

    $json = json_decode($manifest, TRUE);

    foreach ($json as $key => $value) {

      $tmp = explode('/', $key);
      $path = end($tmp);

      if ($path == $resource) {
        if ($url) {
          $file = url('/dist/'.$value);
        } else {
          $file = public_path('/dist/' . $value);
        }

        return $file;
      }
    }
  }

  public static function load_critical_css($file = false) {
  
    if ($file == false) {
      return false;
    }

    //$cdn = 'url(' . ciu_util_get_base_url('front') . '/' . path_to_theme() . '/dist/';
    $styles = file_get_contents(Helpers::load_resource($file, false));
    return $styles;
  }

  public static function load_svg($file) {
    $folder = '/dist/svg/';
    $filename = public_path($folder . $file . '.svg');

    if (file_exists($filename)) {
      return file_get_contents($filename, FILE_USE_INCLUDE_PATH);
    }

    return false;
  }

  private static function inlineStyles($text, $styles) {
    $return = $text;

    if (count($styles) > 0) {

      usort($styles, function($a, $b) {
        return -($a->offset <=>  $b->offset);
      });      
      
      foreach($styles as $style) {
        $tmp = '';
        $raw = substr($text, $style->offset, $style->length);

        switch ($style->style) {
          case 'BOLD':
            $tmp = '<b>' . $raw . '</b>';
          break;
          case 'UNDERLINE':
            $tmp = '<u>' . $raw . '</u>';
          break;     
          case 'ITALIC':
            $tmp = '<i>' . $raw . '</i>';
          break;                    
        }

        $return = substr_replace($return, $tmp, $style->offset, $style->length);
      }
    }

    return nl2br($return);
  }

  static public function draft2html($draftjs) {
    $json = json_decode($draftjs);
    $html = [];
    $is_listWrapper = false;
    
    foreach($json->blocks as $block) {
      
      if (in_array($block->type, array('unordered-list-item', 'ordered-list-item')) == false) {
        if ($is_listWrapper != false) {
          $html[] = $is_listWrapper;
          $is_listWrapper = false;
        }
      }

      $text = Helpers::inlineStyles($block->text, $block->inlineStyleRanges);

      if (nl2br($block->text) != '') {
        switch ($block->type) {
          case 'header-three':
            $html[] = '<h3>' . $text . '</h3>';  
          break;
          case 'header-four':
            $html[] = '<h4>' . $text . '</h4>';  
          break;
          case 'header-five':
            $html[] = '<h5>' . $text . '</h5>';  
          break;
          case 'header-six':
            $html[] = '<h6>' . $text . '</h6>';  
          break;   
          case 'blockquote':
            $html[] = '<blockquote>' . $text . '</blockquote>';  
          break;
          case 'unordered-list-item':
            if ($is_listWrapper == false) {
              $is_listWrapper = '</ul>';
              $html[] = '<ul>';
            }
            $html[] = '<li>' . $text . '</li>';  
          break;
          case 'ordered-list-item':
            if ($is_listWrapper == false) {
              $is_listWrapper = '</ol>';
              $html[] = '<ol>';
            }            
            $html[] = '<li>' . $text . '</li>';  
          break;
          default:
            $html[] = '<p>' . $text . '</p>';
        }
      } else {
        $html[] = '<br />';
      }

    }
    
    return implode('', $html);
    //return $draftjs;
  }

  static public function getLocale() {
    $languages = Request::header('Accept-Language');
    $langs = null;

    if ($languages != null) {
      // break up string into pieces (languages and q factors)
      preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $languages, $lang_parse);

      if (count($lang_parse[1])) {
        // create a list like "en" => 0.8
        $langs = array_combine($lang_parse[1], $lang_parse[4]);

        // set default to 1 for any without q factor
        foreach ($langs as $lang => $val) {
          if ($val === '') $langs[$lang] = 1;
        }

        // sort list based on value
        arsort($langs, SORT_NUMERIC);
      }
    }

    return $langs;
  }

  static function main_menu($accepted) {
    $current = Route::currentRouteName();

    foreach($accepted as $value) {
      if (strpos($current , '.' . $value . '.') != false) {
        return 'selected expanded';
      }
    }
  }

  static function sub_menu($accepted, $excluded = null) {
    $current = Route::currentRouteName();

    if ($excluded != null) {
      if (strpos($current, $excluded) != false) {
        return;
      }
    }

    if (strpos($current, '.' . $accepted . '.') != false) {
      return 'selected';
    }
  }

  static function sub_menu_only($accepted) {
    $current = Route::currentRouteName();

    if (strpos($current, $accepted) != false) {
      return 'selected';
    }
  }

  static function selected_filter($param, $value, $default = false) {
    $request = request();
    $return = 'value="' . $value . '"';

    if ($request->has($param)) {
      if ($request->get($param) == $value) {
        $return .= ' selected';
      } 
    } else {
      if ($default !== false) {
        if ($value == $default) {
          $return .= ' selected';
        }
      }
    }

    return $return;
  }

  static function product_params($inquiry) {
    $title = Helpers::product_title($inquiry);
    $iso = isset($inquiry->iso) ? $inquiry->iso : Inquiry::getIso($inquiry->fk_language);
    
    return array('locale' => $iso, 'name' => Str::slug($title, '-'), 'id' => $inquiry->product_id);
  }

  static function product_title($inquiry) {
    $product = false;
    $id = false;

    if (isset($inquiry->product)) {
      $product = $inquiry->product;
      $id = $inquiry->product_id;
    } elseif (isset($inquiry['product'])) {
      $product = $inquiry['product'];
      $id = $inquiry['product_id'];
    }


    switch ($product) {
      case 'cruise':
        $title = CruiseshipsTranslation::getName($id);
      break;
      case 'excursion':
        $title = ExcursionsTranslation::getName($id);
      break;
      case 'package':
        $title = PackageTranslation::getName($id);
      break;
    }
    
    return $title;
  }

  static function get_active_icon($value){
    $values = array('inactive', 'active');
    return Helpers::load_svg('ico-' . $values[$value]);
  }

  static function get_read_icon($value){
    $values = array('unread', 'read');
    return Helpers::load_svg('ico-' . $values[$value]);
  }

  static function slider_get_url($url) {
    if (filter_var($url, FILTER_VALIDATE_URL)) {
      return $url;
    }

    $data = explode(':', $url);

    if (count($data) == 1) {
      return false;
    } else {
      $routeParams = array('locale' => app()->getLocale(), 'id' => $data[1]);

      switch ($data[0]) {
        case 'excursion':
          $routeParams['name'] = Str::slug(Excursions::getName($data[1], '-'));
        break;
        case 'package':
          $routeParams['name'] = Str::slug(Packages::getName($data[1], '-'));
        break;
        case 'cruiseships':
          $routeParams['name'] = Str::slug(Cruiseships::getName($data[1], '-'));
        break;
      }
      
      return route($data[0], $routeParams);
    }
  }

  static function getThirdParty($key, $default = false) {
    $element = ThirdParties::getValue($key);

    return $element == null ? $default : $element;
  }

  static function getFooterPages() {
    return Pages::getPages('in_footer');
  }

  static function getHeaderPages() {
    return Pages::getPages('in_header');
  }  

  static function getPageBySlug($slug, $language) {
    return PagesTranslation::getSlugByLang($slug, $language);
  }
}

