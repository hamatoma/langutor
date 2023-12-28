@extends('layouts.backend')

@section('content')
<form id="word-edit" action="/word-update/{{ $word->id }}" method="POST">
    @csrf
    <x-laraknife.edit-panel title="{{ __('Change of a Word') }}">
        <x-laraknife.text position="alone" name="name" label="Name" value="{{ $word->id }}" width2="4"/>
        <x-laraknife.bigtext position="alone" name="usage" label="Usage" value="{{ $word->id }}" width2="4"/>
        <x-laraknife.text position="alone" name="wordtype" label="Wordtype" value="{{ $word->id }}" width2="4"/>
        <x-laraknife.text position="alone" name="verifiedby" label="Verifiedby" value="{{ $word->id }}" width2="4"/>
    </x-laraknife.edit-panel>
</form>
@endsection
