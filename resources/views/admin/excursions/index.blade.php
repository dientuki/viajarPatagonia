@extends('layouts.admin')

@section ('content')

@if (isset($excursions))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
        <th colspan="{{count($languages)}}">{{ ucfirst(__('fields.excursion')) }}</th>
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
        @foreach ($excursions as $excursion)
        <tr>
            @foreach ($languages as $language)
              <?php $routeParams = array('locale' => $language->iso, 'name' => Str::slug($excursion['title' . $language->id], '-'), 'id' => $excursion->id); ?>
              <td>
                <a href="{{route('excursion', $routeParams)}}" rel="noopener" target="_blank">{{$excursion['title' . $language->id]}}</a>
              </td>            
            @endforeach
            <td>{{ $excursion->is_active }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.excursions.edit', $excursion->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $excursion['title' . $languages[0]->id] }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.excursions.destroy', $excursion->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $excursion->id)) !!}
                <button id="button-{{ $excursion->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $excursion['title' . $languages[0]->id] }}">
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

<a href="{{route('admin.excursions.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(__('fields.excursion')) }}">{{__('buttons.create')}} {{ ucfirst(__('fields.excursion')) }}</a>
@endif

@endsection