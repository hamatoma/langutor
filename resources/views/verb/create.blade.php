@extends('layouts.backend')

@section('content')
<form id="verb-create" action="/verb-create" method="POST">
    @csrf
    @method('PUT')
    <x-laraknife.create-panel title="{{ __('Creation of a Verb') }}">
        <x-laraknife.text position="first" name="name" label="Infinitive clause" width2="4" />
        <x-laraknife.text position="last" name="presence" label="Presence" width2="4" />
        <x-laraknife.text position="first" name="imperfect" label="Imperfect" width2="4" />
        <x-laraknife.text position="last" name="participle" label="Participle" width2="4" />
        <x-laraknife.text position="alone" name="separablepart" label="Separable part" width2="4" />
        <x-laraknife.text position="alone" name="usage" label="Usage" width2="10" rows="4" />
    </x-laraknife.create-panel>
</form>
@endsection
