<?php use App\Http\Helpers\Helpers; ?>

@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.thirdParty', 2)) }}</div>

  @include ('admin/widgets/order')
</div>

@if (isset($thirdParties))
<table class="table table-striped table-bordered table-hover table-sm sortable">
    <thead class="thead-dark">
        <tr>
            <th>{{ ucfirst(__('fields.name')) }}</th>
            <th>{{ ucfirst(__('fields.code')) }}</th>
            <th class="column-active">{{ ucfirst(__('fields.active')) }}</th>
            <th class="column-action">{{ ucfirst(__('fields.action')) }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($thirdParties as $thirdParty)
        <tr>
            <td>{{ $thirdParty->name }}</td>
            <td>{{ $thirdParty->code }}</td>
            <td class="column-active">{!! Helpers::get_active_icon($thirdParty->is_active ) !!}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.third-parties.edit', $thirdParty->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $thirdParty->thirdParty }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.third-parties.destroy', $thirdParty->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $thirdParty->id)) !!}
                <button id="button-{{ $thirdParty->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $thirdParty->name }}">
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
    <a href="{{route('admin.third-parties.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.thirdParty',1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.thirdParty',1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $thirdParties->links() }}
  </div>
</div>

@include ('admin/widgets/modal-delete')


@endif

@endsection