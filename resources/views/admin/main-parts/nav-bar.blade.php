<!-- Vertical navbar -->
<div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
        <div class="media d-flex align-items-center">
            <img src="http://viajarporpatagonia.com/admin/images/logo.png" width="170" height="33" class="mr-3">
        </div>
    </div>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Mensajes
            </a>
        </li>

        <li class="nav-item">
            <div class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Lugares</div>

            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="{{ route('admin.regions.index') }}" class="nav-link text-dark font-italic">
                        <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                        Regiones
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.destinations.index') }}" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Destinos
                    </a>
                </li>

            </ul>
        </li>
    </ul>

    <hr />

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Cruceros</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Cruceros
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Tipos de cruceros
            </a>
        </li>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Excuriones</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Excuriones
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Tipos de excuriones
            </a>
        </li>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">
        <a href="#" class="nav-link text-dark font-italic bg-light">
            <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
            Paquetes
        </a>
    </p>

    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Configuraciones</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                Lenguajes
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.currencies.index')}}" class="nav-link text-dark font-italic">
                <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                Monedas
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-pie-chart mr-3 text-primary fa-fw"></i>
                Mailchimp
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-line-chart mr-3 text-primary fa-fw"></i>
                Analitics
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-line-chart mr-3 text-primary fa-fw"></i>
                Usuarios
            </a>
        </li>
    </ul>

    <div class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">
        <form action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <input type="submit" class="nav-link text-dark font-italic bg-light" value="Salir" />
        </form>


    </div>
</div>
<!-- End vertical navbar -->