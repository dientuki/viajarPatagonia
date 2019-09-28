<?php

function load_resource($resource, $url = true) {
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