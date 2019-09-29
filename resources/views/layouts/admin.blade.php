<!DOCTYPE html>
<html lang="es">
  <head>
    @include ('admin/main-parts/head')
  </head>

  <body >
    @include ('widgets/alerts')

    @include ('admin/main-parts/nav-bar')

<!-- Page content holder -->
<main class="page-content p-5" id="content">
  <!-- Toggle button -->
  <div id="sidebarCollapse" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></div>

  @yield('content')

</main>

  </body>

</html>