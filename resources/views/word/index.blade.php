@extends('layouts.backend')

@section('content')
<form id="word-index" action="/word-index" method="POST">
    @csrf
    <x-laraknife.index-panel title="{{ __('Words') }}">
        <x-laraknife.filter-panel legend="{{ $pagination->legendText() }}">
            <x-laraknife.combobox position="first" name="genus" label="Gender" :options="$options" width2="4" />
            <x-laraknife.text position="last" name="text" label="Text" value="{{ $fields['text'] }}"
                width2="4" />
            <div class="row">
                <x-laraknife.btn-search width2="10" />
            </div>
        </x-laraknife.filter-panel>
        <x-laraknife.index-button-panel buttonType="new"/>
        <x-laraknife.sortable-table-panel :fields="$fields" :pagination="$pagination">
            <thead>
                <tr>
                    <th></th>
                    <th sortId="name">{{ __('Name') }}</th>
                    <th sortId="usage">{{ __('Usage') }}</th>
                    <th sortId="wordtype">{{ __('Wordtype') }}</th>
                    <th sortId="username">{{ __('Verifiedby') }}</th>
                    <th></th>
                </tr>
            </thead>
            @foreach ($records as $word)
                <tr>
                    <td><a href="/word-edit/{{ $word->id }}">{{ __('Change') }}</a></td>
                    <td>{{ $word->name }}</td>
                    <td>{{ $word->usage }}</td>
                    <td>{{ $word->wordtype }}</td>
                    <td>{{ $word->username }}</td>
                    <td><a href="/word-delete/{{ $word->id }}">{{ __('Delete') }}</a></td>
                </tr>
            @endforeach
            <tbody>
            </tbody>
        </x-laraknife.sortable-table-panel>
    </x-laraknife.index-panel>
</form>
@endsection
