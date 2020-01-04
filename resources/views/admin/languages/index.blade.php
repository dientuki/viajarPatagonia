@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.language', 2)) }}</div>

  @include ('admin/widgets/order', ['default' => "asc"])
</div>

@if (isset($languages))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
            <th>{{ ucfirst(trans_choice('fields.language',1)) }}</th>
            <th>{{ ucfirst(__('fields.iso')) }} ISO 639-1</th>
            <th class="column-action">{{ ucfirst(__('fields.action')) }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($languages as $language)
        <tr>
            <td>{{ $language->language }}</td>
            <td>{{ $language->iso }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.languages.edit', $language->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $language->language }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.languages.destroy', $language->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $language->id)) !!}
                <button id="button-{{ $language->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $language->language }}">
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
    <a href="{{route('admin.languages.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.language',1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.language',1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $languages->links() }}
  </div>
</div>
@include ('admin/widgets/modal-delete')


@endif

@endsection