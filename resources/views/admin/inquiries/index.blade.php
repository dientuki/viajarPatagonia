<?php

use App\Http\Helpers\Helpers;
use App\Translations\Language;
use App\Translations\PackageTranslation;
use App\Translations\ExcursionsTranslation;
use App\Translations\CruiseshipsTranslation;
?>

@extends('layouts.admin')

@section ('content')

  <div class="header-sticky row has-FS">
    <div class="col">{{ ucfirst(trans_choice('fields.inquiry', 2)) }}</div>
    
    <div class="col form-inline row">
      <div class="col">
        <select data-param="is_readed" class="filter form-control">
          <option>{{ ucfirst(__('fields.readPlaceholder')) }}</option>
          <option {!!Helpers::selected_filter('is_readed', 'reset')!!}>{{ ucfirst(__('fields.all')) }}</option>
          <option {!!Helpers::selected_filter('is_readed', 1)!!}>Leido</option>
          <option {!!Helpers::selected_filter('is_readed', 0)!!}>No Leido</option>
        </select>
      </div>
      <div class="col">
        <select data-param="product" class="filter form-control col">
          <option>{{ ucfirst(__('fields.productPlaceholder')) }}</option>
          <option {!!Helpers::selected_filter('product', 'reset')!!}>{{ ucfirst(__('fields.all')) }}</option>
          <option {!!Helpers::selected_filter('product', 'cruise')!!}>Crucero</option>
          <option {!!Helpers::selected_filter('product', 'excursion')!!}>Excursion</option>
          <option {!!Helpers::selected_filter('product', 'package')!!}>{{ ucfirst(trans_choice('fields.package', 1)) }}</option>
        </select>
      </div>
      <div class="col">
        <?php $languages = Language::getAll(); ?>
        <select data-param="iso" class="filter form-control col">
        <option>{{ ucfirst(__('fields.languagePlaceholder')) }}</option>
        <option {!!Helpers::selected_filter('iso', 'reset')!!}>{{ ucfirst(__('fields.all')) }}</option>
          @foreach ($languages as $language)
            <option {!!Helpers::selected_filter('iso', $language->iso)!!}>{{ $language->language }}</option>
          @endforeach
        </select>  
      </div>      
    </div>

    @include ('admin/widgets/order')
  </div>

@if (isset($inquiries))
<table class="table table-striped table-bordered table-hover table-sm inquiry">
    <thead class="thead-dark">
        <tr>
            <th class="column-active">{{ ucfirst(__('fields.is_readed')) }}</th>
            <th>{{ ucfirst(__('fields.name')) }}</th>
            <th>{{ ucfirst(__('fields.product')) }}</th>
            <th>{{ ucfirst(trans_choice('fields.language',1)) }}</th>
            <th>{{ ucfirst(__('fields.comment')) }}</th>
            <th>{{ ucfirst(__('fields.date')) }}</th>            
            <th class="column-action">{{ ucfirst(__('fields.action')) }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inquiries as $inquiry)
        <tr>
            <td class="column-active">{!! Helpers::get_read_icon($inquiry->is_readed ) !!}</td>
            <td class="inquiry__name"><div class="clamp-two">{{ $inquiry->name }}</div></td>
            <td class="inquiry__product">
              <a title="{{ Helpers::product_title($inquiry) }}" rel="noopener" target="_blank" href="{{route($inquiry->product, Helpers::product_params($inquiry))}}">{!! Helpers::load_svg('ico-' . $inquiry->product ) !!}</a>
            </td>
            <td class="inquiry__flag">{!! Helpers::load_svg('lang-' . $inquiry->iso ) !!}</td>
            <td class="inquiry__comment"><div class="clamp-one">{{ $inquiry->comment }}</div></td>
            <td class="inquiry__date">{{ $inquiry->timestamp }}</td>

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

<div class="row">
  <div class="col-sm d-flex">
    {{ $inquiries->links() }}
  </div>
</div>



@include ('admin/widgets/modal-delete')

@endif

@endsection