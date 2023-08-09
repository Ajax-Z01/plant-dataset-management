@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">{{ __('Accuracy Plot') }}</div>
                <div class="card-body">
                    <img src="{{ asset('assets/plot1.png') }}" alt="My Plot">
                    <pre>{{ $output }}</pre>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">{{ __('Loss Plot') }}</div>
                <div class="card-body">
                    <img src="{{ asset('assets/plot2.png') }}" alt="My Plot">
                    <pre>{{ $output }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
