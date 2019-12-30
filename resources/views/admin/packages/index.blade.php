<?php use App\Http\Helpers\Helpers; ?>

@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.package', 2)) }}</div>

  @include ('admin/widgets/order')
</div>

@if (isset($packages))
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
        @foreach ($packages as $package)
        <tr>
            @foreach ($languages as $language)
              <?php $routeParams = array('locale' => $language->iso, 'name' => Str::slug($package['title' . $language->id], '-'), 'id' => $package->id); ?>
              <td>
                <a href="{{route('package', $routeParams)}}" rel="noopener" target="_blank">{{$package['title' . $language->id]}}</a>
              </td>               
            @endforeach
            <td class="column-active">{!! Helpers::get_active_icon($package->is_active ) !!}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.packages.edit', $package->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $package['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.packages.destroy', $package->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $package->id)) !!}
                <button id="button-{{ $package->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $package['title' . $languages[0]->id] }}">
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
    <a href="{{route('admin.packages.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.package',1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.package',1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $packages->links() }}
  </div>
</div>

@include ('admin/widgets/modal-delete')
@endif

@endsection