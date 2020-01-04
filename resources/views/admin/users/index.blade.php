@extends('layouts.admin')

@section ('content')

<div class="header-sticky row has-FS">
  <div class="col">{{ ucfirst(trans_choice('fields.user', 2)) }}</div>

  @include ('admin/widgets/order')
</div>

@if (isset($users))
<table class="table table-striped table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
            <th>{{ ucfirst(__('fields.name')) }}</th>
            <th>{{ ucfirst(__('fields.email')) }}</th>
            <th class="column-action">{{ ucfirst(__('fields.action')) }}</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = auth()->user()->id; ?>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary col" title="{{__('buttons.edit')}} {{ $user->name }}">{{__('buttons.edit')}}</a>
                
                @if ($id != $user->id)
                  {!! Form::open(array('route' => array('admin.users.destroy', $user->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $user->id)) !!}
                  <button id="button-{{ $user->id }}" type="submit" class="btn btn-danger modalDelete"
                      title="{{__('buttons.delete')}} {{ $user->name }}">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                      {{__('buttons.delete') }}</button>
                  {!! Form::close() !!}
                @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
  <div class="col-sm">
    <a href="{{route('admin.users.create')}}" class="btn btn-primary" title="{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.user',1)) }}">{{__('buttons.create')}} {{ ucfirst(trans_choice('fields.user',1)) }}</a>
  </div>
  <div class="col-sm d-flex">
    {{ $users->links() }}
  </div>
</div>
@include ('admin/widgets/modal-delete')


@endif

@endsection