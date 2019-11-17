@extends('layouts.admin')

@section ('content')

@if (isset($homesliders))
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
        @foreach ($homesliders as $homeslider)
        <tr>
            @foreach ($languages as $language)
              <td>
                {{$homeslider['title' . $language->id]}}
              </td>            
            @endforeach
            <td>{{ $homeslider->is_active }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.homeslider.edit', $homeslider->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $homeslider['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif

@endsection