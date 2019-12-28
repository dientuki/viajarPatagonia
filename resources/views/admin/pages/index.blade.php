<?php use App\Http\Helpers\Helpers; ?>

@extends('layouts.admin')

@section ('content')

<div class="header-sticky row">
  <div class="col">{{ ucfirst(trans_choice('fields.page', 2)) }}</div>
</div>

@if (isset($pages))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        @foreach ($languages as $language)
            <th>{{$language->language}}</th>
        @endforeach
        <th class="column-active">{{ ucfirst(__('fields.active')) }}</th>
        <th class="column-action">Accion</th>        
        </tr>        
    </thead>
    <tbody>
        @foreach ($pages as $page)
        <tr>
            @foreach ($languages as $language)
              <?php $routeParams = array('locale' => $language->iso, 'name' => Str::slug($page['title' . $language->id], '-'), 'id' => $page->id); ?>
              <td>
                <a href="{{route('cruise', $routeParams)}}" rel="noopener" target="_blank">{{$page['title' . $language->id]}}</a>
              </td>
            @endforeach
            <td class="column-active">{!! Helpers::get_active_icon($page->is_active ) !!}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $page['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.pages.destroy', $page->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $page->id)) !!}
                <button id="button-{{ $page->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $page['title' . $languages[0]->id] }}">
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
    <a href="{{route('admin.pages.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} ucfirst(trans_choice('fields.page', 1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.page', 1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $pages->links() }}
  </div>
</div>

@include ('admin/widgets/modal-delete')

@endif

@endsection