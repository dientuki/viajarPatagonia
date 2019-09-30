@extends('layouts.admin')

@section ('content')

    @if (isset($regions))
    <table class="list-table" id="list-table">
        <thead class="hidden">
            <tr>
                <th>Region</th>
                <th class="column-action">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regions as $region)
            <tr>
                <td>{{ $region->region }}</td>

                <td class="column-action">
                    <a href="{{route('admin.regions.edit', $region->id)}}" class="btn btn-primary btn-sm" role="button"
                        title="Editar {{ $region->region }}">Editar</a>
              {!! Form::open(array('route' => array('admin.regions.destroy', $region->id), 'method' => 'DELETE', 'class' => 'form-inline')) !!}
                <button type="submit" class="btn btn-danger btn-sm" title="Borrar {{ $region->region }}">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Borrar</button>
              {!! Form::close() !!}

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{route('admin.regions.create')}}">Crear</a>
    @else
    Enhorabuena! No hay usuarios para activar!
    @endif

@endsection