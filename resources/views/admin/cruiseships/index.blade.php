@push('scripts')
  <script src="{{ load_resource('adminAbm-list.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

@if (isset($cruiseships))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        <th colspan="{{count($languages)}}">{{ ucfirst(__('fields.cruiseship')) }}</th>
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
        @foreach ($cruiseships as $cruiseship)
        <tr>
            @foreach ($languages as $language)
                <td>{{$cruiseship['title' . $language->id]}}</td>
            @endforeach
            <td>{{ $cruiseship->is_active }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.cruiseships.edit', $cruiseship->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $cruiseship['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.cruiseships.destroy', $cruiseship->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $cruiseship->id)) !!}
                <button id="button-{{ $cruiseship->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $cruiseship['title' . $languages[0]->id] }}">
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

<a href="{{route('admin.cruiseships.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.cruiseship')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.cruiseship')) }}</a>
@endif

@endsection