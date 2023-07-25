@extends('layouts.app')

@section('auth')


    @if(\Request::is('dashboard')) 
        @include('layouts.navbars.auth.nav')
        @yield('content')
        @include('layouts.footers.auth.footer')
        {{-- @include('components.fixed-plugin') --}}
    
    @elseif (\Request::is('profile'))
        @include('layouts.navbars.auth.nav')
        @yield('content')
        @include('layouts.footers.auth.footer')
        {{-- @include('components.fixed-plugin') --}}
    
    @else
        @if (\Request::is('create-project'))
            @include('layouts.navbars.auth.nav')
            @yield('content')
            @include('layouts.footers.auth.footer')
            {{-- @include('components.fixed-plugin') --}}

        @elseif (\Request::is('notification'))  
            <div class="main-content position-relative">
                @include('layouts.navbars.auth.nav')
                @yield('content')
            </div>

        @elseif (\Request::is('view-project'))
            @include('layouts.navbars.auth.nav')
            @yield('content')
            <div class="position-fixed-botom">
                @include('layouts.footers.auth.footer')
            </div>
            @include('components.fixed-plugin')

        @else
            <div class="col-md-12">
                @include('layouts.navbars.auth.nav')
                @yield('content')
                @include('layouts.footers.auth.footer')
            </div>
        @endif

    @endif

@endsection