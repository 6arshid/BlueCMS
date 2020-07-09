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


@php


var_dump($setting_data);

@endphp
                    @if (auth()->check())
                    @if (auth()->user()->is_admin === 1)
                    Hello Admin You must click <a href="/admin/home">here</a> for manage website
                    @else
                    Hello standard user
                    @endif
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
