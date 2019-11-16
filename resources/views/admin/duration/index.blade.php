@extends('layouts.admin')

@section ('content')

@if (isset($duration))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        <th colspan="{{count($languages)}}">{{ ucfirst(__('fields.duration')) }}</th>
        <th class="column-action" rowspan="2">Accion</th>
        </tr>
        <tr>
        @foreach ($languages as $language)
            <th>{{$language->language}}</th>
        @endforeach
        </tr>        
    </thead>
    <tbody>
        @foreach ($duration as $item)
        <tr>
            @foreach ($languages as $language)
                <td>{{$item['type' . $language->id]}}</td>
            @endforeach

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.duration.edit', $item->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $item['type' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.duration.destroy', $item->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $item->id)) !!}
                <button id="button-{{ $item->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $item['type' . $languages[0]->id] }}">
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

<a href="{{route('admin.duration.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.duration')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.duration')) }}</a>
@endif

@endsection