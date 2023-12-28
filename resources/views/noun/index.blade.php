@extends('layouts.backend')

@section('content')
<form id="noun-index" action="/noun-index" method="POST">
    @csrf
    <x-laraknife.index-panel title="{{ __('Noun') }}">
        <x-laraknife.filter-panel legend="{{$pagination->legendText()}}">
            <x-laraknife.combobox position="first" name="genus" label="Gender" :options="$options"
                class="lkn-autoupdate" width2="4" />
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
                    <th sortId="article">{{ __('Article') }}</th>
                    <th sortId="name">{{ __('Name') }}</th>
                    <th>{{ __('Plural') }}</th>
                    <th sortId="genusstr">{{ __('Gender') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $noun)
                    <tr>
                        <td><x-laraknife.change-record module="noun" key="{{ $noun->id }}" /></td>
                        <td>{{ $noun->article }}</td>
                        <td>{{ $noun->name }}</td>
                        <td>{{ $noun->plural }}</td>
                        <td>{{ __($noun->genusstr) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </x-laraknife.sortable-table-panel>
    </x-laraknife.index-panel>
</form>
@endsection
