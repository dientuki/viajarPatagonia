<?php use App\Http\Helpers\Helpers; ?>
<div>
  Nombre: {{ $valid['name'] }} <br />
  Email: {{ $valid['email'] }} <br />
  Telefono: {{ $valid['phone'] }} <br />
  Fecha de salida: {{ $valid['departure'] }} <br />
  Adultos: {{ $valid['adult'] }}, Niños: {{ $valid['child'] }}
  Producto: {{ Helpers::product_title($valid) }}
  Comentario: <br />
  {{ $valid['comment'] }}
</div>