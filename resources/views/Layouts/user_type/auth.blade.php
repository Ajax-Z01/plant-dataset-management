@extends('layouts.app')

@section('auth')


    @if(\Request::is('dashboard')) 
        @include('layouts.navbars.auth.nav')
        @yield('content')
        @include('layouts.footers.auth.footer')
    
    @elseif (\Request::is('profile'))
        @include('layouts.navbars.auth.nav')
        @yield('content')
        @include('layouts.footers.auth.footer')
    
    @else
        @if (\Request::is('create-project'))
            @include('layouts.navbars.auth.nav')
            @yield('content')
            @include('layouts.footers.auth.footer')


        @elseif (\Request::is('view-project'))
            @include('layouts.navbars.auth.nav')
            @yield('content')
            <div class="position-fixed-botom">
                @include('layouts.footers.auth.footer')
            </div>
        
        @elseif (\Request::is('result-project'))
            @include('layouts.navbars.auth.nav')
            @yield('content')
            <div class="position-fixed-botom">
                @include('layouts.footers.auth.footer')
            </div>

        @else
            <div class="col-md-12">
                @include('layouts.navbars.auth.nav')
                @yield('content')
                @include('layouts.footers.auth.footer')
            </div>
        @endif

    @endif

@endsection