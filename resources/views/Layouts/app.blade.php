<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/logos/dataset-leaf.png')}}">
  <title>
    Plant Dataset Management
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="{{asset('assets/fontawesome/css/all.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/fontawesome/css/fontawesome.css')}}" rel="stylesheet">
  <link href="{{asset('assets/fontawesome/css/brands.css')}}" rel="stylesheet">
  <link href="{{asset('assets/fontawesome/css/solid.css')}}" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />
  <!-- Tags Input -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <style>
    .bootstrap-tagsinput{
      width: 100%;
      border: 1px solid #d2d6da;
      margin-bottom: 1.5rem;
      padding: 0.5rem 0.75rem;
      background: #fff;
      border-radius: 12px;
      display: block;
      box-shadow: 0 0.25rem 0.375rem -0.0625rem hsla(0, 0%, 8%, 0.12), 0 0.125rem 0.25rem -0.0625rem hsla(0, 0%, 8%, 0.07);
    }

    .bootstrap-tagsinput .tag {
      margin-right: 2px;
      padding: 3px 10px;
      color: #40513B;
      background: #DDFFBB;
      border-radius: 15px;
      font-size: small;
      font-weight: 600;
    }

    .bootstrap-tagsinput input{
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.4rem;
    }

    .bootstrap-tagsinput.form-control input::-moz-placeholder {
      color: #adb5bd;
      opacity: 1;
    }
    .bootstrap-tagsinput.form-control input:-ms-input-placeholder {
      color: #adb5bd;
      opacity: 1;
    }
    .bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
      color: #adb5bd;
      opacity: 1;
    }
    .bootstrap-tagsinput .tag [data-role="remove"] {
      margin-left: 8px;
      cursor: pointer;
    }
    .bootstrap-tagsinput .tag [data-role="remove"]:after {
      content: "x";
      padding: 2px 2px;
    }
    .bootstrap-tagsinput .tag [data-role="remove"]:hover {
      box-shadow: none;
    }
    .bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
      box-shadow: none;
    }
  </style>
</head>

<body class="offline-doc">
  
  @yield('auth')

  @yield('guest')


  @if(session()->has('success'))
  <div x-data="{ show: true}"
      x-init="setTimeout(() => show = false, 4000)"
      x-show="show"
      class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
    <p class="m-0">{{ session('success')}}</p>
  </div>
  @endif 

  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  {{-- <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script> --}}
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <!-- Tags Input -->
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  

  @stack('dashboard')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/soft-ui-dashboard.min.js?v=1.0.6')}}"></script>
</body>

</html>