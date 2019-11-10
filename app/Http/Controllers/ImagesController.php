<?php

namespace App\Http\Controllers;

use Spatie\Image\Image;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Request;

class ImagesController extends Controller
{
    public function getClientHint($id, $slug, $ext) {
      $width = Request::header('Width');
      $dpr = is_int(Request::header('DPR')) ? Request::header('DPR') : 1;

      if ($width == null) {
        $media = Media::find($id);
        return response()->file($media->getPath());
      }

      $path = storage_path('app/public/' . $id . '/ch/');
      $filename = $path . $dpr . '-' . $width . '.' . $ext;
      
      if (file_exists($filename) == false) {
        if (is_dir($path) == false) {
          mkdir($path);
        }
        $media = Media::find($id);
        $image = Image::load($media->getPath());
        $image->devicePixelRatio($dpr)->width($width)->optimize()->save($filename);
      }
      
      return response()->file($filename);
    }
}