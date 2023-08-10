@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-5">
            <div class="card">
                <div class="card-header">{{ __('Accuracy Plot') }}</div>
                <div class="card-body">
                    <img class="img-fluid" src="{{ asset('assets/plot1.png') }}" alt="My Plot">
                </div>
            </div>
        </div>
        <div class="col-2"></div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">{{ __('Loss Plot') }}</div>
                <div class="card-body">
                    <img class="img-fluid" src="{{ asset('assets/plot2.png') }}" alt="My Plot">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
