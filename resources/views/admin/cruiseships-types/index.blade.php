@push('scripts')
  <script src="{{ load_resource('adminAbm-list.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

@if (isset($cruiseshipsTypes))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        <th colspan="{{count($languages)}}">{{ ucfirst(__('fields.cruiseshipType')) }}</th>
        <th class="column-action" rowspan="2">Accion</th>
        </tr>
        <tr>
        @foreach ($languages as $language)
            <th>{{$language->language}}</th>
        @endforeach
        </tr>        
    </thead>
    <tbody>
        @foreach ($cruiseshipsTypes as $cruiseshipType)
        <tr>
            @foreach ($languages as $language)
                <td>{{$cruiseshipType['type' . $language->id]}}</td>
            @endforeach

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.cruiseships-types.edit', $cruiseshipType->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $cruiseshipType['type' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.cruiseships-types.destroy', $cruiseshipType->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $cruiseshipType->id)) !!}
                <button id="button-{{ $cruiseshipType->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $cruiseshipType['type' . $languages[0]->id] }}">
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

<a href="{{route('admin.cruiseships-types.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.cruiseshipType')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.cruiseshipType')) }}</a>
@endif

@endsection