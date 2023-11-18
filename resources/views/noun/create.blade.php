@extends('layouts.backend')

@section('content')
    <form id="noun-create" action="/noun-create" method="POST">
        @csrf
        @method('PUT')
        <div id="main-content" class="container mt-5">
            <x-laraknife.main-header title="{{ __('Creation of a Noun') }}" />

            <div class="fieldset">
                <x-laraknife.text position="first" name="name" label="Name" width2="4" />
                <x-laraknife.text position="last" name="plural" label="Plural" width2="4" />

                <x-laraknife.combobox position="alone" name="genus" label="Genus" options="{!! $options !!}"
                    width2="4" />

                <x-laraknife.bigtext position="alone" name="usage" label="Usage" width2="10" rows="4" />
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
