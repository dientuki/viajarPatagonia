@push('scripts')
  <script src="{{ load_resource('adminAbm-list.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

@if (isset($destinations))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
            <th>{{ ucfirst(__('fields.destination')) }}</th>
            <th>{{ ucfirst(__('fields.region')) }}</th>
            <th class="column-action">Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($destinations as $destination)
        <tr>
            <td>{{ $destination->destination }}</td>
            <td>{{ $destination->region }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.destinations.edit', $destination->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $destination->destination }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.destinations.destroy', $destination->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $destination->id)) !!}
                <button id="button-{{ $destination->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $destination->destination }}">
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

<a href="{{route('admin.destinations.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.destination')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.destination')) }}</a>
@endif

@endsection