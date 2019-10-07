@extends('layouts.admin')

@section ('content')

@if (isset($languages))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
            <th>{{ ucfirst(__('fields.language')) }}</th>
            <th>{{ ucfirst(__('fields.iso')) }}</th>
            <th class="column-action">Accion</th>
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

@include ('admin/widgets/modal-delete')

<a href="{{route('admin.languages.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.language')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.language')) }}</a>
@endif

@endsection