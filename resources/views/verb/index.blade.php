@extends('layouts.backend')

@section('content')
<form id="verb-index" action="/verb-index" method="POST">
    @csrf
    <x-laraknife.index-panel title="{{ __('Verbs') }}">
        <x-laraknife.filter-panel legend="{{ $pagination->legendText() }}">
            <x-laraknife.combobox position="first" name="genus" label="Gender" :options="$options" width2="4" />
            <x-laraknife.text position="last" name="text" label="Text" value="{{ $fields['text'] }}"
                width2="4" />
        </x-laraknife.filter-panel>
        <x-laraknife.index-button-panel buttonType="new"/>
        <x-laraknife.sortable-table-panel :fields="$fields" :pagination="$pagination">
            <thead>
                <tr>
                    <th></th>
                    <th sortId="word_id">{{ __('Word_id') }}</th>
                    <th sortId="presence">{{ __('Presence') }}</th>
                    <th sortId="imperfect"">{{ __('Imperfect') }}</th>
                    <th sortId="participle">{{ __('Participle') }}</th>
                    <th sortId="separablepart">{{ __('Separablepart') }}</th>
                    <th sortId="verifiedby">{{ __('Verifiedby') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $verb)
                    <tr>
                        <td><a href="/verb-edit/{{ $verb->id }}">{{ __('Change') }}</a></td>
                        <td>{{ $verb->word_id }}</td>
                        <td>{{ $verb->presence }}</td>
                        <td>{{ $verb->imperfect }}</td>
                        <td>{{ $verb->participle }}</td>
                        <td>{{ $verb->separablepart }}</td>
                        <td>{{ $verb->verifiedby }}</td>
                        <td><a href="/verb-delete/{{ $verb->id }}">{{ __('Delete') }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </x-laraknife.sortable-table-panel>
    </x-laraknife.index-panel>
</form>
@endsection
