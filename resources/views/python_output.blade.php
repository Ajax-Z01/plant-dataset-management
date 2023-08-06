@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Python Script Output') }}</div>

                <div class="card-body">
                    <img src="{{ asset('assets/myplot.png') }}" alt="My Plot"><pre>{{ $output }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
