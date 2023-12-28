@extends('layouts.backend')

@section('content')
<form id="noun-create" action="/noun-create" method="POST">
    @csrf
    @method('PUT')
    <x-laraknife.create-panel title="{{ __('Creation of a Noun') }}">
        <x-laraknife.text position="first" name="name" label="Name" width2="4" />
        <x-laraknife.text position="last" name="plural" label="Plural" width2="4" />

        <x-laraknife.combobox position="alone" name="genus" label="Genus" :options="$options" width2="4" />
    </x-laraknife.create-panel>
</form>
@endsection
