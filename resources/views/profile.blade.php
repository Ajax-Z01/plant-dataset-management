
@extends('layouts.user_type.auth')

@section('content')
  <div class="main-content position-relative my-5 mx-6">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{asset('assets/img/curved-images/green-3.jpg')}}'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ auth()->user()->avatar }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ auth()->user()->name }}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                CEO / Co-Founder
              </p>
            </div>
          </div>
          <div class="col-auto my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-0 rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <i class="fas fa-user-edit text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
              <span class="font-weight-bold">Edit Profile</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-5">
      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="card h-100">
            <div class="card-header mx-2 pb-0">
              <h5 class="mb-1">Profile Information</h5>
            </div>
            <div class="card-body p-3 pt-0">
              <p class="text-lg m-3">{{ auth()->user()->about_me }}</p>
              <ul class="list-group m-3">
                <li class="list-group-item border-0 ps-0 pt-0 text-lg"><strong class="text-dark">
                  <span><i class="fa-solid fa-user pe-2" style="color: #344767 ;"></i></span>
                  Full Name:</strong> &nbsp; {{ auth()->user()->name }}
                </li>
                <li class="list-group-item border-0 ps-0 text-lg"><strong class="text-dark">
                  <span><i class="fa-solid fa-mobile-screen-button pe-2" style="color: #344767 ;"></i></span>
                  Mobile:</strong> &nbsp; {{ auth()->user()->phone }}
                </li>
                <li class="list-group-item border-0 ps-0 text-lg"><strong class="text-dark">
                  <span><i class="fa-solid fa-envelope pe-2" style="color: #344767 ;"></i></span>
                  Email:</strong> &nbsp; {{ auth()->user()->email }}
                </li>
                <li class="list-group-item border-0 ps-0 text-lg"><strong class="text-dark">
                  <span><i class="fa-solid fa-location-dot pe-2" style="color: #344767 ;"></i></span>
                  Location:</strong> &nbsp; {{ auth()->user()->location }}
                </li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-lg">Social:</strong> &nbsp;
                  <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-facebook fa-xl"></i>
                  </a>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-xl"></i>
                  </a>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-xl"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
        </div>
        <form action="{{ route('edit.profile') }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="mb-3">
              <i class="fa-solid fa-user" style="color: #000000;"></i>
              <label for="name" class="form-label">Full Name</label>
              <input name="name" type="text" class="form-control" id="name" value="{{ auth()->user()->name }}" placeholder="Full Name">
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-mobile-screen-button" style="color: #000000;"></i>
              <label for="phone" class="form-label">Mobile</label>
              <input name="phone" type="tel" class="form-control" id="phone" value="{{ auth()->user()->phone }}" placeholder="Mobile">
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-envelope" style="color: #000000;"></i>
              <label for="email" class="form-label">Email</label>
              <input name="email" type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" placeholder="Email">
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-location-dot" style="color: #000000;"></i>
              <label for="location" class="form-label">Location</label>
              <input name="loaction" type="text" class="form-control" id="location" value="{{ auth()->user()->location }}" placeholder="Location">
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-quote-left" style="color: #000000;"></i>
              <label for="description" class="form-label">About Me</label>
              <textarea class="form-control" id="description" rows="3">{{ auth()->user()->about_me }}</textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary py-2 rounded-pill" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary py-2 rounded-pill">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection