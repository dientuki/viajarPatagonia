<?php

use App\Http\Helpers\Helpers;
use App\Translations\Language;
use App\Translations\PackageTranslation;
use App\Translations\ExcursionsTranslation;
use App\Translations\CruiseshipsTranslation;
?>

@extends('layouts.admin')

@section ('content')

  <div class="header-sticky">
    {{ ucfirst(__('fields.inquiries')) }}
    Filter:
    
    <select data-param="is_readed" class="filter">
      <option {!!Helpers::selected_filter('is_readed', 'reset')!!}>Todos</option>
      <option {!!Helpers::selected_filter('is_readed', 1)!!}>Leido</option>
      <option {!!Helpers::selected_filter('is_readed', 0)!!}>No Leido</option>
    </select>
    <select data-param="product" class="filter">
      <option {!!Helpers::selected_filter('product', 'reset')!!}>Todos</option>
      <option {!!Helpers::selected_filter('product', 'cruise')!!}>Crucero</option>
      <option {!!Helpers::selected_filter('product', 'excursion')!!}>Excursion</option>
      <option {!!Helpers::selected_filter('product', 'package')!!}>Paquete</option>
    </select>
    
    <?php $languages = Language::getAll(); ?>
    <select data-param="iso" class="filter">
     <option {!!Helpers::selected_filter('iso', 'reset')!!}>Todos</option>
      @foreach ($languages as $language)
        <option {!!Helpers::selected_filter('iso', $language->iso)!!}>{{ $language->language }}</option>
      @endforeach
    </select>        

    <select data-param="order" class="sort">
      <option {!!Helpers::selected_filter('order', 'asc')!!}>Asc</option>
      <option {!!Helpers::selected_filter('order', 'desc', true)!!}>Desc</option>
    </select>         
  </div>

@if (isset($inquiries))
<table class="table table-striped table-bordered table-hover table-sm inquiry">
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
            <td class="inquiry__product">
              <a title="{{ Helpers::product_title($inquiry) }}" rel="noopener" target="_blank" href="{{route($inquiry->product, Helpers::product_params($inquiry))}}">{!! Helpers::load_svg('ico-' . $inquiry->product ) !!}</a>
            </td>
            <td class="inquiry__flag">{!! Helpers::load_svg('lang-' . $inquiry->iso ) !!}</td>
            <td class="inquiry__comment"><div class="clamp">{{ $inquiry->comment }}</div></td>
            <td>{{ $inquiry->timestamp }}</td>

            <td class="column-action px-4">
                <div class="row">
                <a href="{{route('admin.inquiries.edit', $inquiry->id)}}" class="btn btn-primary col" title="{{__('buttons.show')}}">{{__('buttons.show')}}</a>
                
                {!! Form::open(array('route' => array('admin.inquiries.destroy', $inquiry->id), 'method' => 'DELETE', 'class' => 'col modalOpener', 'id' => 'id-' . $inquiry->id)) !!}
                <button id="button-{{ $inquiry->id }}" type="submit" class="btn btn-danger modalDelete"
                    title="{{__('buttons.delete')}}">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    {{__('buttons.delete') }}</button>
                {!! Form::close() !!}
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $inquiries->links() }}

@include ('admin/widgets/modal-delete')

@endif

@endsection