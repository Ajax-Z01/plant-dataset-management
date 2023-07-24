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

              @foreach ($collaborators as $collaborator)
              <li class="list-group-item border-0 ps-0 text-lg"><strong style="color: #285430">
                <span><i class="fa-solid fa-user pe-2" style="color: #285430 ;"></i></span>
                Collaborator :</strong> &nbsp; {{ $project->collaborator }}
              </li>
              @endforeach
              
              {{-- @foreach ($countFiles as $countFile) --}}
              <li class="list-group-item border-0 ps-0 text-lg"><strong style="color: #285430">
                <span><i class="fab fa-envira pe-2" style="color: #285430 ;"></i></span>
                Items :</strong> &nbsp; 
                  {{-- {{ str_replace('public/datasets', 'storage/datasets', $countFile) }} --}}
              </li>
              {{-- @endforeach --}}
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row row-cols-7 g-2 g-lg-3 px-4">
    @foreach ($files as $file)
    <div class="col px-2 py-4">
      <div class="card text-center">
        <img src="{{ str_replace('public/datasets', 'storage/datasets', $file) }}" class="card-img-top" alt="image" />
        <div class="card-body">
          <h5 class="card-title text-sm">Card title</h5>
          <a href="#" class="btn btn-danger mt-2" style="background-color: #850000">Delete</a>
          {{-- <a href="#" class="btn btn-primary">Button</a> --}}
          {{-- <p class="card-text">
            This is a longer card with supporting text below as a natural lead-in to
            additional content. This content is a little bit longer.
          </p> --}}
        </div>
      </div>
    </div>
    @endforeach
    {{-- <div class="col">
      <div class="card">
        <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp" class="card-img-top"
          alt="Palm Springs Road" />
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">
            This is a longer card with supporting text below as a natural lead-in to
            additional content. This content is a little bit longer.
          </p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/043.webp" class="card-img-top"
          alt="Los Angeles Skyscrapers" />
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
            additional content.</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/044.webp" class="card-img-top"
          alt="Skyscrapers" />
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">
            This is a longer card with supporting text below as a natural lead-in to
            additional content. This content is a little bit longer.
          </p>
        </div>
      </div>
    </div> --}}
  </div>
    
@endsection