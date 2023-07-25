@extends('layouts.user_type.auth')

@section('content')
  @foreach($projects as $project)
    <div class="text-center mt-3">
      <h3>{{ $project->title }}</h3>
    </div>
  @endforeach

  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="card">
          <div class="card-body p-2">
            <ul class="list-group m-3" style="color: #285430">
              @foreach($labels as $label)
              <li class="list-group-item border-0 ps-0 pt-0 text-lg"><strong style="color: #285430">
                <span><i class="fas fa-tags pe-2" style="color: #285430 ;"></i></span>
                Label :</strong> &nbsp; {{ $project->label }}
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row row-cols-7 g-2 g-lg-3 px-4">
    @foreach ($s3storage as $file)
    <div class="col px-2 py-4">
      <div class="card text-center">
        {{-- <img src="{{ str_replace('public/datasets', 'storage/datasets', $file) }}" class="card-img-top" alt="image" /> --}}
        <img src="{{ $file }}" class="card-img-top" alt="image" />
        <div class="card-body">
          <h5 class="card-title text-sm">Card title</h5>
          <a href="#" class="btn btn-danger mt-2" style="background-color: #850000">Delete</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
    
@endsection