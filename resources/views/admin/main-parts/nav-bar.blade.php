<?php use App\Http\Helpers\Helpers; ?>

<!-- Vertical navbar -->
<div class="vertical-nav" id="sidebar">
  <div>
      <img src="http://viajarporpatagonia.com/admin/images/logo.png" width="170" height="33" class="mr-3">
  </div>

  <div class="main-nav__title-wrapper">
    <div class="main-nav__icon">icono</div>
    <div class="main-nav__title">Collapsar</div>    
  </div>

  <nav class="main-nav">
    <ul>
      <!-- paquetes -->
      <li class="main-nav__item must-expand {{ Helpers::main_menu(['packages']) }}">
        <div class="main-nav__title-wrapper">
          <div class="main-nav__icon">icono</div>
          <div class="main-nav__title">Paquetes</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li"><a href="{{route('admin.packages.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Ver paquetes</a></li>
          <li class="main-nav__li"><a href="{{route('admin.packages.create')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Nuevo paquete</a></li>
        </ul>
      </li>
      
      <!-- cruceros -->
      <li class="main-nav__item {{ Helpers::main_menu(['cruiseships', 'cruiseships-types']) }}">
        <div class="main-nav__title-wrapper must-expand">
          <div class="main-nav__icon">icono</div>
          <div class="main-nav__title">Cruceros</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li"><a href="{{route('admin.cruiseships-types.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Ver tipos de cruceros</a></li>  
          <li class="main-nav__li"><a href="{{route('admin.cruiseships.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Ver cruceros</a></li>
          <li class="main-nav__li"><a href="{{route('admin.cruiseships.create')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Nuevo crucero</a></li>
        </ul>
      </li>

      <!-- excursiones -->
      <li class="main-nav__item {{ Helpers::main_menu(['excursions', 'availability', 'duration', 'excursions-types']) }}">
        <div class="main-nav__title-wrapper must-expand">
          <div class="main-nav__icon">icono</div>
          <div class="main-nav__title">Excursiones</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li"><a href="{{route('admin.availability.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Ver disponibilidad</a></li>  
          <li class="main-nav__li"><a href="{{route('admin.duration.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Ver duracion</a></li>
          <li class="main-nav__li"><a href="{{route('admin.excursions-types.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Ver tipo de excuriones</a></li>
          <li class="main-nav__li"><a href="{{route('admin.excursions.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Ver excursiones</a></li>
          <li class="main-nav__li"><a href="{{route('admin.excursions.create')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Nueva excursion</a></li>
        </ul>
      </li>   
      
      <!-- lugares -->
      <li class="main-nav__item {{ Helpers::main_menu(['regions', 'destinations']) }}">
        <div class="main-nav__title-wrapper must-expand">
          <div class="main-nav__icon">icono</div>
          <div class="main-nav__title">Lugares</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li"><a href="{{route('admin.regions.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Regiones</a></li>  
          <li class="main-nav__li"><a href="{{route('admin.destinations.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Destinos</a></li>
        </ul>
      </li>   
      
      <!-- configuracion -->
      <li class="main-nav__item {{ Helpers::main_menu(['languages', 'currencies', 'users']) }}">
        <div class="main-nav__title-wrapper must-expand">
          <div class="main-nav__icon">icono</div>
          <div class="main-nav__title">Configuracion</div>
        </div>
        <ul class="main-nav__submenu">
          <li class="main-nav__li"><a href="{{route('admin.languages.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Lenguajes</a></li>  
          <li class="main-nav__li"><a href="{{route('admin.currencies.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Monedas</a></li>
          <li class="main-nav__li"><a href="{{route('admin.users.index')}}" class="main-nav__link {{ Helpers::sub_menu() }}">Usuarios</a></li>
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