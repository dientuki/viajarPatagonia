<?php use App\Http\Helpers\Helpers; ?>

@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.cruiseship', 2)) }}</div>

  @include ('admin/widgets/order')
</div>

@if (isset($cruiseships))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        @foreach ($languages as $language)
            <th>{{$language->language}}</th>
        @endforeach
        <th class="column-active">{{ ucfirst(__('fields.active')) }}</th>
        <th class="column-action">{{ ucfirst(__('fields.action')) }}</th>        
        </tr>        
    </thead>
    <tbody>
        @foreach ($cruiseships as $cruiseship)
        <tr>
            @foreach ($languages as $language)
              <?php $routeParams = array('locale' => $language->iso, 'name' => Str::slug($cruiseship['title' . $language->id], '-'), 'id' => $cruiseship->id); ?>
              <td>
                <a href="{{route('cruise', $routeParams)}}" rel="noopener" target="_blank">{{$cruiseship['title' . $language->id]}}</a>
              </td>
            @endforeach
            <td class="column-active">{!! Helpers::get_active_icon($cruiseship->is_active ) !!}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.cruiseships.edit', $cruiseship->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $cruiseship['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.cruiseships.destroy', $cruiseship->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $cruiseship->id)) !!}
                <button id="button-{{ $cruiseship->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $cruiseship['title' . $languages[0]->id] }}">
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
    <a href="{{route('admin.cruiseships.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} ucfirst(trans_choice('fields.cruiseship', 1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.cruiseship', 1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $cruiseships->links() }}
  </div>
</div>

@include ('admin/widgets/modal-delete')

@endif

@endsection