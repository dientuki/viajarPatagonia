@extends('layouts.admin')

@section ('content')

<div class="header-sticky row">
  <div class="col">{{ ucfirst(trans_choice('fields.currency', 2)) }}</div>

  @include ('admin/widgets/order', ['default' => 'asc'])
</div>

@if (isset($currencies))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
            <th>{{ ucfirst(__('fields.sign')) }}</th>
            <th>{{ ucfirst(__('fields.iso')) }} ISO 4217</th>
            <th>{{ ucfirst(trans_choice('fields.currency',1)) }}</th>
            <th>{{ ucfirst(__('fields.amount')) }}</th>
            <th class="column-action">Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($currencies as $currency)
        <tr>
            <td>{{ $currency->sign }}</td>
            <td>{{ $currency->iso }}</td>
            <td>{{ $currency->currency }}</td>
            <td>{{ $currency->amount }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.currencies.edit', $currency->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $currency->currency }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.currencies.destroy', $currency->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $currency->id)) !!}
                <button id="button-{{ $currency->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $currency->currency }}">
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
    <a href="{{route('admin.currencies.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.currency',1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.currency',1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $currencies->links() }}
  </div>
</div>

@include ('admin/widgets/modal-delete')


@endif

@endsection