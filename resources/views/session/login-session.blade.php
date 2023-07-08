@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-5 d-flex flex-column mx-auto">
              <div class="card card-plain mt-7">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder mb-4 text-success text-gradient">Welcome back</h3>
                  <p class="mb-0">Manage your dataset and find the right model using machine learning</p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="/session">
                    @csrf
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                      @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                      @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    {{-- <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div> --}}
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-success w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 pb-0 px-sm-2 px-1">
                {{-- <small class="text-muted">Forgot you password? Reset you password 
                  <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">here</a>
                </small> --}}
                  <p class="mb-3 text-sm mx-auto">
                    Don't have an account?
                    <a href="{{ url('register') }}" class="text-success text-gradient font-weight-bold">Sign up</a>
                  </p>
                  <p class="text-sm font-weight-bold">
                    OR
                  </p>
                </div>
                <div class="row px-xl-5 px-sm-4 px-3">
                  <div class="text-center me-auto px-1">
                    <a class="btn btn-outline-dark w-24" href='{{ route('google.redirect') }}'>
                      <svg width="24px" height="32px" style="margin-bottom:3px; margin-right:5px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Artboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="google-icon" transform="translate(3.000000, 2.000000)" fill-rule="nonzero">
                            <path d="M57.8123233,30.1515267 C57.8123233,27.7263183 57.6155321,25.9565533 57.1896408,24.1212666 L29.4960833,24.1212666 L29.4960833,35.0674653 L45.7515771,35.0674653 C45.4239683,37.7877475 43.6542033,41.8844383 39.7213169,44.6372555 L39.6661883,45.0037254 L48.4223791,51.7870338 L49.0290201,51.8475849 C54.6004021,46.7020943 57.8123233,39.1313952 57.8123233,30.1515267" id="Path" fill="#4285F4"></path>
                            <path d="M29.4960833,58.9921667 C37.4599129,58.9921667 44.1456164,56.3701671 49.0290201,51.8475849 L39.7213169,44.6372555 C37.2305867,46.3742596 33.887622,47.5868638 29.4960833,47.5868638 C21.6960582,47.5868638 15.0758763,42.4415991 12.7159637,35.3297782 L12.3700541,35.3591501 L3.26524241,42.4054492 L3.14617358,42.736447 C7.9965904,52.3717589 17.959737,58.9921667 29.4960833,58.9921667" id="Path" fill="#34A853"></path>
                            <path d="M12.7159637,35.3297782 C12.0932812,33.4944915 11.7329116,31.5279353 11.7329116,29.4960833 C11.7329116,27.4640054 12.0932812,25.4976752 12.6832029,23.6623884 L12.6667095,23.2715173 L3.44779955,16.1120237 L3.14617358,16.2554937 C1.14708246,20.2539019 0,24.7439491 0,29.4960833 C0,34.2482175 1.14708246,38.7380388 3.14617358,42.736447 L12.7159637,35.3297782" id="Path" fill="#FBBC05"></path>
                            <path d="M29.4960833,11.4050769 C35.0347044,11.4050769 38.7707997,13.7975244 40.9011602,15.7968415 L49.2255853,7.66898166 C44.1130815,2.91684746 37.4599129,0 29.4960833,0 C17.959737,0 7.9965904,6.62018183 3.14617358,16.2554937 L12.6832029,23.6623884 C15.0758763,16.5505675 21.6960582,11.4050769 29.4960833,11.4050769" id="Path" fill="#EB4335"></path>
                          </g>
                        </g>
                      </svg>
                      Continue with Google
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n4">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n7" style="background-image:url('{{asset('assets/img/curved-images/green-1.jpg')}}')" ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
