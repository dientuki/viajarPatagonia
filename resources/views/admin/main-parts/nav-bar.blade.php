<?php use App\Http\Helpers\Helpers; ?>

<!-- Vertical navbar -->
<div class="vertical-nav" id="sidebar">

  <div class="main-nav__title-wrapper vertical-nav__action" >
    <div id="sidebarCollapse" class="main-nav__icon">{!! Helpers::load_svg('ico-menu') !!}</div>
    <div class="main-nav__title"><img src="{{ asset('images/logo.png') }}" width="200"></div>    
  </div>

  <nav class="main-nav">
    <ul>
      <!-- paquetes -->
      <li class="main-nav__item {{ Helpers::main_menu(['packages']) }}">
        <div class="main-nav__title-wrapper must-expand">
          <div class="main-nav__icon">{!! Helpers::load_svg('ico-packages') !!}</div>
          <div class="main-nav__title">Paquetes</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li {{ Helpers::sub_menu('packages', 'create') }}"><a href="{{route('admin.packages.index')}}" class="main-nav__link">Ver paquetes</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu_only('packages.create') }}"><a href="{{route('admin.packages.create')}}" class="main-nav__link">Nuevo paquete</a></li>
        </ul>
      </li>
      
      <!-- cruceros -->
      <li class="main-nav__item {{ Helpers::main_menu(['cruiseships', 'cruiseships-types']) }}">
        <div class="main-nav__title-wrapper must-expand">
          <div class="main-nav__icon">{!! Helpers::load_svg('ico-ship') !!}</div>
          <div class="main-nav__title">Cruceros</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li {{ Helpers::sub_menu('cruiseships-types') }}"><a href="{{route('admin.cruiseships-types.index')}}" class="main-nav__link">Ver tipos de cruceros</a></li>  
          <li class="main-nav__li {{ Helpers::sub_menu('cruiseships', 'create') }}"><a href="{{route('admin.cruiseships.index')}}" class="main-nav__link">Ver cruceros</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu_only('cruiseships.create') }}"><a href="{{route('admin.cruiseships.create')}}" class="main-nav__link">Nuevo crucero</a></li>
        </ul>
      </li>

      <!-- excursiones -->
      <li class="main-nav__item {{ Helpers::main_menu(['excursions', 'availability', 'duration', 'excursions-types']) }}">
        <div class="main-nav__title-wrapper must-expand">
          <div class="main-nav__icon">{!! Helpers::load_svg('ico-binoculars') !!}</div>
          <div class="main-nav__title">Excursiones</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li {{ Helpers::sub_menu('availability') }}"><a href="{{route('admin.availability.index')}}" class="main-nav__link">Ver disponibilidad</a></li>  
          <li class="main-nav__li {{ Helpers::sub_menu('duration') }}"><a href="{{route('admin.duration.index')}}" class="main-nav__link ">Ver duracion</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu('excursions-types') }}"><a href="{{route('admin.excursions-types.index')}}" class="main-nav__link ">Ver tipo de excuriones</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu('excursions', 'create') }}"><a href="{{route('admin.excursions.index')}}" class="main-nav__link ">Ver excursiones</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu_only('excursions.create') }}"><a href="{{route('admin.excursions.create')}}" class="main-nav__link ">Nueva excursion</a></li>
        </ul>
      </li>   
      
      <!-- lugares -->
      <li class="main-nav__item {{ Helpers::main_menu(['regions', 'destinations']) }}">
        <div class="main-nav__title-wrapper">
          <div class="main-nav__icon">{!! Helpers::load_svg('ico-inquiries') !!}</div>
          <div class="main-nav__title"><a href="{{route('admin.regions.index')}}" class="main-nav__link {{ Helpers::sub_menu('regions') }}">Consultas</a></div>
        </div>
      </li> 
      
      <!-- slider -->
      <li class="main-nav__item {{ Helpers::main_menu(['homeslider']) }}">
        <div class="main-nav__title-wrapper">
          <div class="main-nav__icon">{!! Helpers::load_svg('ico-slider') !!}</div>
          <div class="main-nav__title"><a href="{{route('admin.homeslider.index')}}" class="main-nav__link">Slider</a></div>
        </div>
      </li>      
      
      <!-- configuracion -->
      <li class="main-nav__item {{ Helpers::main_menu(['users', 'destinations', 'regions', 'languages', 'currencies']) }}">
        <div class="main-nav__title-wrapper must-expand">
          <div class="main-nav__icon">{!! Helpers::load_svg('ico-settings') !!}</div>
          <div class="main-nav__title">Configuracion</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li {{ Helpers::sub_menu('users') }}"><a href="{{route('admin.users.index')}}" class="main-nav__link">Usuarios</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu('destinations') }}"><a href="{{route('admin.destinations.index')}}" class="main-nav__link">Paginas</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu('regions') }}"><a href="{{route('admin.regions.index')}}" class="main-nav__link">Regiones</a></li>  
          <li class="main-nav__li {{ Helpers::sub_menu('destinations') }}"><a href="{{route('admin.destinations.index')}}" class="main-nav__link">Destinos</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu('languages') }}"><a href="{{route('admin.languages.index')}}" class="main-nav__link">Lenguajes</a></li>  
          <li class="main-nav__li {{ Helpers::sub_menu('currencies') }}"><a href="{{route('admin.currencies.index')}}" class="main-nav__link">Monedas</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu('currencies') }}"><a href="{{route('admin.currencies.index')}}" class="main-nav__link">Third party</a></li>
          <li class="main-nav__li {{ Helpers::sub_menu('currencies') }}"><a href="{{route('admin.currencies.index')}}" class="main-nav__link">Footer</a></li>
        </ul>
      </li>    
      
      <li class="main-nav__item">
        <form action="{{ route('logout') }}" method="POST">
          {{ csrf_field() }}
          <button class="main-nav__title-wrapper">
            <div class="main-nav__icon">icono</div>
            <div class="main-nav__title">Salir</div>            
          </button>
        </form>
      </li>
    </ul>
  </nav>
</div>

<!-- End vertical navbar -->