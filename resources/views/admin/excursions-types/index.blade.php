@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.excursionType', 2)) }}</div>

  @include ('admin/widgets/order')
</div>

@if (isset($excursionsTypes))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        @foreach ($languages as $language)
            <th>{{$language->language}}</th>
        @endforeach
        <th class="column-action" >Accion</th>
        </tr>        
    </thead>
    <tbody>
        @foreach ($excursionsTypes as $excursionType)
        <tr>
            @foreach ($languages as $language)
                <td>{{$excursionType['type' . $language->id]}}</td>
            @endforeach

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.excursions-types.edit', $excursionType->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $excursionType['type' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.excursions-types.destroy', $excursionType->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $excursionType->id)) !!}
                <button id="button-{{ $excursionType->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $excursionType['type' . $languages[0]->id] }}">
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
    <a href="{{route('admin.excursions-types.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.excursionType', 1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.excursionType', 1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $excursionsTypes->links() }}
  </div>
</div>

@include ('admin/widgets/modal-delete')


@endif

@endsection