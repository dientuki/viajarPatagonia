@push('scripts')
  <script src="{{ load_resource('adminAbm-list.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

@if (isset($excursionsTypes))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        <th colspan="{{count($languages)}}">{{ ucfirst(__('fields.excursionType')) }}</th>
        <th class="column-action" rowspan="2">Accion</th>
        </tr>
        <tr>
        @foreach ($languages as $language)
            <th>{{$language->language}}</th>
        @endforeach
        </tr>        
    </thead>
    <tbody>
        @foreach ($excursionsTypes as $excursionType)
        <tr>
            @foreach ($languages as $language)
                <td>{{$excursionType['type' . $language->id]}}</td>
            @endforeach

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.excursions-types.edit', $excursionType->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $excursionType['type' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.excursions-types.destroy', $excursionType->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $excursionType->id)) !!}
                <button id="button-{{ $excursionType->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $excursionType['type' . $languages[0]->id] }}">
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

<a href="{{route('admin.excursions-types.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.excursionType')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.excursionType')) }}</a>
@endif

@endsection