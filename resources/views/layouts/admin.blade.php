<!DOCTYPE html>
<html lang="es">
  <head>
    @include ('admin/main-parts/head', ['jsfile' => 'adminForm'])
  </head>

  <body >
    @include ('widgets/alerts')

    @include ('admin/main-parts/nav-bar')

    <!-- Page content holder -->
    <main class="page-content p-5" id="content">

      @yield('content')

    </main>

  </body>

</html>