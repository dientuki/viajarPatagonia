@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.destination', 2)) }}</div>

  @include ('admin/widgets/order', ['default' => 'asc'])
</div>

@if (isset($destinations))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
            <th>{{ ucfirst(trans_choice('fields.destination',1)) }}</th>
            <th>{{ ucfirst(trans_choice('fields.region',1)) }}</th>
            <th class="column-action">{{ ucfirst(__('fields.action')) }}</th>
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

<div class="row">
  <div class="col-sm">
    <a href="{{route('admin.destinations.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.destination',1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.destination',1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $destinations->links() }}
  </div>
</div>
@include ('admin/widgets/modal-delete')

@endif

@endsection