@extends('layouts.app')

@section('auth')


    @if(\Request::is('dashboard')) 
        @include('layouts.navbars.auth.nav')
        @yield('content')
        @include('layouts.footers.auth.footer')
        @include('components.fixed-plugin')
        
        @elseif (\Request::is('profile'))
        @include('layouts.navbars.auth.nav')
        @yield('content')
        @include('layouts.footers.auth.footer')
        @include('components.fixed-plugin')
    
    @else
        @if (\Request::is('create-project'))
            {{-- <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('layouts.navbars.auth.nav-rtl')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main> --}}
            @include('layouts.navbars.auth.nav')
            @yield('content')
            @include('layouts.footers.auth.footer')
            @include('components.fixed-plugin')

        @elseif (\Request::is('notification'))  
            <div class="main-content position-relative">
                @include('layouts.navbars.auth.nav')
                @yield('content')
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