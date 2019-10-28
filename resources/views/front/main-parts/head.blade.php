
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>Titulo</title>

<!-- Scripts -->
<script src="{{ load_resource('frontJs.js') }}" defer crossorigin="anonymous"></script>

<!-- Fonts -->
<link rel="preload" href="{{ load_resource('Roboto-Regular.woff2') }}" as="font" type="font/woff2" crossorigin />
<link rel="preload" href="{{ load_resource('Roboto-Regular.woff') }}" as="font" type="font/woff" crossorigin />

<!-- Styles -->
<link href="{{ load_resource('frontStyle.css') }}" rel="preload" as="style" onload="this.rel = 'stylesheet'" />