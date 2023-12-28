@extends('layouts.backend')

@section('content')
<form id="noun-edit" action="/noun-update/{{$noun->id}}" method="POST">
    @csrf
    <x-laraknife.edit-panel  title="{{ __('Change of a Noun') }}">
        <x-laraknife.text position="first" name="name" label="Name" value="{{ $word->name }}" width2="4" attribute="readonly" />
        <x-laraknife.text position="last" name="plural" label="Plural" value="{{ $noun->plural }}" width2="4" />

        <x-laraknife.combobox position="alone" name="genus" label="Genus" selected="" :options="$options"
            width2="4" />

        <x-laraknife.bigtext position="alone" name="usage" label="Usage" value="{{ $word->usage }}" width2="10" rows="4" />
    </x-laraknife.edit-panel>
</form>
@endsection
