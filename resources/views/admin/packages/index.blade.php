@extends('layouts.admin')

@section ('content')

@if (isset($packages))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        <th colspan="{{count($languages)}}">{{ ucfirst(__('fields.package')) }}</th>
        <th rowspan="2">{{ ucfirst(__('fields.active')) }}</th>
        <th class="column-action" rowspan="2">Accion</th>
        </tr>
        <tr>
        @foreach ($languages as $language)
            <th>{{$language->language}}</th>
        @endforeach
        </tr>        
    </thead>
    <tbody>
        @foreach ($packages as $package)
        <tr>
            @foreach ($languages as $language)
                <td>{{$package['title' . $language->id]}}</td>
            @endforeach
            <td>{{ $package->is_active }}</td>

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

@include ('admin/widgets/modal-delete')

<a href="{{route('admin.packages.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.package')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.package')) }}</a>
@endif

@endsection