@extends('layouts.backend')

@section('content')
<form id="verb-edit" action="/verb-update/{{ $verb->id }}" method="POST">
    @csrf
    <x-laraknife.edit-panel  title="{{ __('Change of a Verb') }}">
        <x-laraknife.text position="first" name="word_id" label="Word_id" value="{{ $word->name }}" width2="4"/>
        <x-laraknife.text position="last" name="presence" label="Presence" value="{{ $verb->presence }}" width2="4"/>
        <x-laraknife.text position="first" name="imperfect" label="Imperfect" value="{{ $verb->imperfect }}" width2="4"/>
        <x-laraknife.text position="last" name="participle" label="Participle" value="{{ $verb->participle }}" width2="4"/>
        <x-laraknife.text position="alone" name="separablepart" label="Separablepart" value="{{ $verb->separablepart }}" width2="4"/>
        <x-laraknife.text position="alone" name="usage" label="Verifiedby" value="{{ $word->usage }}" width2="4"/>
        <x-laraknife.form-error />
    </x-laraknife.edit-panel >
</form>
@endsection
