@extends('layouts.backend')

@section('content')
<form id="word-create" action="/word-create" method="POST">
    @csrf
    @method('PUT')
    <x-laraknife.create-panel title="{{ __('Creation of a Word') }}">
        <x-laraknife.text position="alone" name="name" label="Name" width2="4" />
        <x-laraknife.bigtext position="alone" name="usage" label="Usage" width2="4" rows="2" />
        <x-laraknife.text position="alone" name="wordtype" label="Wordtype" width2="4" />
        <x-laraknife.text position="alone" name="verifiedby" label="Verifiedby" width2="4" />
    </x-laraknife.create-panel>
</form>
@endsection
