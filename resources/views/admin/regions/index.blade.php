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
                        title="{{__('buttons.edit')}} {{ $region->region }}">{{__('buttons.edit')}}</a>
              {!! Form::open(array('route' => array('admin.regions.destroy', $region->id), 'method' => 'DELETE', 'class' => 'form-inline')) !!}
                <button class="modalDelete" id="button-{{ $region->id }}" type="submit" class="btn btn-danger btn-sm" title="{{__('buttons.delete')}} {{ $region->region }}" data-toggle="modal" data-target="#deleteModal">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> {{__('buttons.delete') }}</button>
              {!! Form::close() !!}

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    @include ('admin/widgets/modal')

    <a href="{{route('admin.regions.create')}}">Crear</a>
    @else
    Enhorabuena! No hay usuarios para activar!
    @endif

@endsection