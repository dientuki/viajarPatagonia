@extends('layouts.admin')

@section ('content')

@if (isset($homeslider))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        <th colspan="{{count($languages)}}">{{ ucfirst(__('fields.homeslider')) }}</th>
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
        @foreach ($homeslider as $slider)
        <tr>
            @foreach ($languages as $language)
              <td>
                {{$slider['title' . $language->id]}}
              </td>            
            @endforeach
            <td>{{ $slider->is_active }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.homeslider.edit', $slider->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $slider['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                {!! Form::open(array('route' => array('admin.homeslider.destroy', $slider->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $slider->id)) !!}
                <button id="button-{{ $slider->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $slider['title' . $languages[0]->id] }}">
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

<a href="{{route('admin.excursions.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.slider')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.slider')) }}</a>
<a href="{{route('admin.homeslider.order')}}" class="btn btn-secondary" title="{{__('buttons.reorder')}} {{ ucfirst(__('fields.homeslider')) }}">{{__('buttons.reorder')}} {{ ucfirst(__('fields.homeslider')) }}</a>


@endif

@endsection