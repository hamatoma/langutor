@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    <ul>
                        <li><a href="/sproperty-index">{{ __("Scoped Properties") }}</li>
                        <li><a href="/user-index">{{ __("Users") }}</li>
                        <li><a href="/role-index">{{ __("Roles") }}</li>
                        <!--li><a href="/user-index">{{ __("Users") }}</li-->
                        <li><a href="/noun-index">{{ __("Nouns") }}</li>
                        <li><a href="/verb-index">{{ __("Verbs") }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
