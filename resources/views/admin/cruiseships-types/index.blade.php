@extends('layouts.admin')

@section ('content')

@if (isset($cruiseshipsTypes))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        <th colspan="3">Tipo de crucero</th>
        <th class="column-action" rowspan="2">Accion</th>
        </tr>
        <tr>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        </tr>        
    </thead>
    <tbody>
        @foreach ($cruiseshipsTypes as $cruiseshipType)
        <tr>
            <td>{{$cruiseshipType->type}}</td>
            <td>{{$cruiseshipType->iso}}</td>
            <td>s</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.cruiseships-types.edit', $cruiseshipType->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $cruiseshipType->id }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.cruiseships-types.destroy', $cruiseshipType->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $cruiseshipType->id)) !!}
                <button id="button-{{ $cruiseshipType->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $cruiseshipType->region }}">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    {{__('buttons.delete') }}</button>
                {!! Form::close() !!}
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include ('admin/widgets/modal-delete')

<a href="{{route('admin.cruiseships-types.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.region')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.region')) }}</a>
@endif

@endsection