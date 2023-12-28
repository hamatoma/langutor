@extends('layouts.backend')

@section('content')
<form id="word-show" action="/word-show/{{ $word->id }}/delete" method="POST">
    @csrf
    @if ($mode === 'delete')
    @method('DELETE')
    @endif
    <x-laraknife.show-panel title="{{ __($mode === 'delete' ? 'Deletion of a Word' : 'A Word') }}" mode="{{$mode}}">
        <x-laraknife.text position="first" name="id" label="Id" value="{{ $word->id }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="alone" name="name" label="Name" value="{{ $word->name }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="alone" name="usage" label="Usage" value="{{ $word->usage }}" width2="4"
            attribute="readonly" rows="2" />
        <x-laraknife.text position="alone" name="wordtype" label="Wordtype" value="{{ $word->wordtype }}" width2="4"
            attribute="readonly" />
        <x-laraknife.text position="alone" name="verifiedby" label="Verifiedby" value="{{ $word->verifiedby }}" width2="4"
            attribute="readonly" />
    </x-laraknife.show-panel>
</form>
@endsection
