@extends('layouts.backend')

@section('content')
    <form id="noun-index" action="/noun-index" method="POST">
        @csrf
        <div id="main-content" class="container mt-5">
            <x-laraknife.main-header title="{{ __('Noun') }}" />

                <!-- panel.filter -->
                <fieldset class="kn-filter">
                    <legend>{{ $legend }}</legend>
                        <x-laraknife.combobox position="first" name="genus" label="Gender" options="{!!$options!!}" width2="4" />
                        <x-laraknife.text position="last" name="text" label="Text" value="{{$fields['text']}}" width2="4" />
                    <div class="row">
                      <x-laraknife.btn-search width2="10" />
                    </div>
                  </fieldset>
                <div class="kn-behind-filter">
                  <div class="row">
                  <x-laraknife.btn-new width1="0" width2="12" />
                  </div>
                </div>
            <div class="kn-form-table">
                <table class="table table-striped kn-table-db">
                  <thead>
                      <tr>
                          <th></th>
                          <th>{{__('Article')}}</th><th>{{__('Name')}}</th><th>{{__('Plural')}}</th>
                          <th>{{__('Gender')}}</th>
                      </tr>
                  </thead>
                  @foreach ($records as $noun)
                  <tr>
                    <td><x-laraknife.change-record module="noun" key="{{$noun->id}}" /></td>
                      <td>{{$noun->article}}</td>
                      <td>{{$noun->name}}</td>
                      <td>{{$noun->plural}}</td>
                      <td>{{__($noun->genusstr)}}</td>
                  </tr>
              @endforeach
                <tbody>
                  </tbody>
                </table>
            </div>
        </div>
    </form>
@endsection
