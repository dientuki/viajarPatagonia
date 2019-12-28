<!DOCTYPE html>
<html lang="es" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
  <head>
    @include ('front/main-parts/head')
  </head>

  <body >
    @include ('widgets/alerts')

    @include ('front/main-parts/header')

    @include ('front/widgets/slider-header')
    
    @yield('content')

    @include ('front/main-parts/footer')

    @include ('front/main-parts/scripts')

  </body>

</html>