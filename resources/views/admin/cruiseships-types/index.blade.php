@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.cruiseshipType', 2)) }}</div>

  @include ('admin/widgets/order')
</div>

@if (isset($cruiseshipsTypes))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        @foreach ($languages as $language)
            <th>{{$language->language}}</th>
        @endforeach
        <th class="column-action">{{ ucfirst(__('fields.action')) }}</th>
        </tr>        
    </thead>
    <tbody>
        @foreach ($cruiseshipsTypes as $cruiseshipType)
        <tr>
            @foreach ($languages as $language)
                <td>{{$cruiseshipType['type' . $language->id]}}</td>
            @endforeach

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.cruiseships-types.edit', $cruiseshipType->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $cruiseshipType['type' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.cruiseships-types.destroy', $cruiseshipType->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $cruiseshipType->id)) !!}
                <button id="button-{{ $cruiseshipType->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $cruiseshipType['type' . $languages[0]->id] }}">
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
    <a href="{{route('admin.cruiseships-types.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.cruiseshipType', 1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.cruiseshipType', 1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $cruiseshipsTypes->links() }}
  </div>
</div>

@include ('admin/widgets/modal-delete')

@endif

@endsection