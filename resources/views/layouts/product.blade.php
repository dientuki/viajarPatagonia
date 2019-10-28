<!DOCTYPE html>
<html lang="es">
  <head>
    @include ('front/main-parts/head')
  </head>

  <body >
    @include ('widgets/alerts')

    @include ('front/main-parts/header')

    @include ('front/widget/slider-header')
    
    @yield('content')

    @include ('front/main-parts/footer')

  </body>

</html>