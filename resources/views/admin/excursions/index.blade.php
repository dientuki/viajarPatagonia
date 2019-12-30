<?php use App\Http\Helpers\Helpers; ?>

@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.excursion', 2)) }}</div>

  @include ('admin/widgets/order')
</div>

@if (isset($excursions))
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
        @foreach ($excursions as $excursion)
        <tr>
            @foreach ($languages as $language)
              <?php $routeParams = array('locale' => $language->iso, 'name' => Str::slug($excursion['title' . $language->id], '-'), 'id' => $excursion->id); ?>
              <td>
                <a href="{{route('excursion', $routeParams)}}" rel="noopener" target="_blank">{{$excursion['title' . $language->id]}}</a>
              </td>            
            @endforeach
            <td class="column-active">{!! Helpers::get_active_icon($excursion->is_active ) !!}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.excursions.edit', $excursion->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $excursion['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.excursions.destroy', $excursion->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $excursion->id)) !!}
                <button id="button-{{ $excursion->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $excursion['title' . $languages[0]->id] }}">
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
    <a href="{{route('admin.excursions.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.excursion',1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.excursion',1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $excursions->links() }}
  </div>
</div>
@include ('admin/widgets/modal-delete')

@endif

@endsection