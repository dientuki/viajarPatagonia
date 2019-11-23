@extends('layouts.admin')

@section ('content')

@if (isset($inquiries))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
            <th>{{ ucfirst(__('fields.is_readed')) }}</th>
            <th>{{ ucfirst(__('fields.name')) }}</th>
            <th>{{ ucfirst(__('fields.product')) }}</th>
            <th>{{ ucfirst(__('fields.language')) }}</th>
            <th>{{ ucfirst(__('fields.comment')) }}</th>
            <th>{{ ucfirst(__('fields.date')) }}</th>            
            <th class="column-action">Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inquiries as $inquiry)
        <tr>
            <td>{{ $inquiry->is_readed }}</td>
            <td>{{ $inquiry->name }}</td>
            <td>{{ $inquiry->product }}</td>
            <td>{{ $inquiry->iso }}</td>
            <td>{{ $inquiry->comment }}</td>
            <td>{{ $inquiry->timestamp }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.inquiries.edit', $inquiry->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $inquiry->region }}">{{__('buttons.edit')}}</a>
                
                {!! Form::open(array('route' => array('admin.inquiries.destroy', $inquiry->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $inquiry->id)) !!}
                <button id="button-{{ $inquiry->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}} {{ $inquiry->region }}">
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

@endif

@endsection