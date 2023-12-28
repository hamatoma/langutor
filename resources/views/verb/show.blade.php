@extends('layouts.backend')

@section('content')
<form id="verb-show" action="/verb-show/{{ $verb->id }}/delete" method="POST">
    @csrf
    @method('DELETE')
        @if ($mode === 'delete')
        @method('DELETE')
        @endif
    <x-laraknife.create-panel title="{{ __($mode === 'Deletion of a Verb' ? 'A Verb' : 'A Role') }}">
        <x-laraknife.text position="first" name="id" label="Id" value="{{ $verb->id }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="last" name="name" label="Infinitive" value="{{ $word->name }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="first" name="presence" label="Presence" value="{{ $verb->presence }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="last" name="imperfect" label="Imperfect" value="{{ $verb->imperfect }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="first" name="participle" label="Participle" value="{{ $verb->participle }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="last" name="separablepart" label="Separablepart" value="{{ $verb->separablepart }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="alone" name="usage" label="Usage" value="{{ $word->verifiedby }}" width2="10"
            attribute="readonly" rows="4" />
    </x-laraknife.create-panel>
</form>
@endsection
