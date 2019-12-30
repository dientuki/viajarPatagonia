<?php use App\Http\Helpers\Helpers; ?>

@extends('layouts.admin')

@section ('content')

<div class="header-sticky row">
  <div class="col">{{ ucfirst(__('fields.homeslider')) }}</div>
</div>

@if (isset($homeslider))
<table class="table table-striped table-bordered table-hover table-sm sortable">
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
        @foreach ($homeslider as $slider)
        <tr class="order" data-order="{{$slider->order}}" data-id="{{$slider->id}}" draggable="true">
            @foreach ($languages as $language)
              <td>
                {{$slider['title' . $language->id]}}
              </td>            
            @endforeach
            <td class="column-active">{!! Helpers::get_active_icon($slider->is_active ) !!}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.homeslider.edit', $slider->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $slider['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                {!! Form::open(array('route' => array('admin.homeslider.destroy', $slider->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $slider->id)) !!}
                <button id="button-{{ $slider->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $slider['title' . $languages[0]->id] }}">
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
    <a href="{{route('admin.homeslider.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.slider')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.slider')) }}</a>
    <button data-href="{{route('admin.homeslider.order')}}" class="btn btn-secondary sortable-update" title="{{ucfirst(__('buttons.apply'))}} {{ ucfirst(__('fields.order')) }}">{{ ucfirst(__('buttons.apply')) }} {{ __('fields.order') }}</button>
  </div>
  <div class="col-sm d-flex">
    {{ $homeslider->links() }}
  </div>
</div>
@include ('admin/widgets/modal-delete')



@endif

@endsection