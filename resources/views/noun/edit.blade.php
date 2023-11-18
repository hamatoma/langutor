@extends('layouts.backend')

@section('content')
    <form id="noun-edit" action="/noun-update/{{$noun->id}}" method="POST">
        @csrf
        <div id="main-content" class="container mt-5">
            <x-laraknife.main-header title="{{ __('Change of a Noun') }}" />

            <div class="fieldset">
                <x-laraknife.text position="first" name="name" label="Name" value="{{ $noun->name }}" width2="4" />
                <x-laraknife.text position="last" name="plural" label="Plural" value="{{ $noun->plural }}" width2="4" />

                <x-laraknife.combobox position="alone" name="genus" label="Genus" selected="" options="{!! $options !!}"
                    width2="4" />

                <x-laraknife.bigtext position="alone" name="usage" label="Usage" value="{{ $noun->usage }}" width2="10" rows="4" />
                <x-laraknife.row-empty />
                <div class="row">
                    <x-laraknife.btn-store width1="2" width2="4" />
                    <x-laraknife.btn-cancel url="/noun-index" width1="2" width2="4" />
                </div>
            </div>
            <x-laraknife.form-error />
        </div>
    </form>
@endsection
