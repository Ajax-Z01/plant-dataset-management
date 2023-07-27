@extends('layouts.user_type.auth')

@section('content')
  <div class="container-fluid py-3" >
    <div class="card">
      @foreach($projects as $project)
        <div class="text-center text-uppercase mt-3">
          <h3>{{ $project->title }}</h3>
        </div>
      @endforeach
      <div class="row">
        <div class="col-7">
          <div class="card-body p-2">
            <ul class="list-group m-3" style="color: #285430">
              @foreach($labels as $label)
              <li class="list-group-item border-0 ps-0 pt-0 text-lg"><strong style="color: #285430">
                <span><i class="fas fa-tags pe-2" style="color: #285430 ;"></i></span>
                Label :</strong> &nbsp; {{ $label->name }}
              </li>
              @endforeach
            </ul>
            <div class="row">
              <div class="col-8 d-flex align-items-center">
                <select class="form-select" aria-label="Default select example">
                  @foreach ($labels as $label)
                  <option selected>{{ $label->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-4 d-flex justify-content-start">
                <div class="button">
                  <a class="btn bg-gradient-success btn-sm py-1 px-3 my-2 fs-6">save</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-5">
          <h5 class="text-center m-3">Display Image</h5>
          <img class="mx-auto d-block py-4" id="image" src="" alt="">
        </div>
      </div>
      <!-- Button trigger modal -->
      <div class="button d-flex justify-content-center my-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <a class="btn bg-gradient-success btn-sm my-2">SUBMIT</a>
      </div>
    </div>
  </div>

  <div class="row row-cols-7 g-2 g-lg-3 px-4">
    @foreach ($files as $file)
    <div class="col px-2 py-4">
      <div class="card text-center">
        @php
        $imageUrl = Storage::disk('s3')->url($file);
        @endphp
      <img src="{{ $imageUrl }}" class="card-img-top" alt="image" />
        <div class="card-body">
          <h5 class="card-title text-sm">Card title</h5>
          <a href="#" class="btn btn-danger mt-2" style="background-color: #285430" onclick="show('{{ $imageUrl }}')">Show</a>
          <a href="#" class="btn btn-danger mt-2" style="background-color: #850000">Delete</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">SETUP PROJECT</h1>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="label" class="form-label">Architecture</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Inceptionv3</option>
                    <option value="1">AlexNet</option>
                    <option value="2">DenseNet121</option>
                    <option value="3">VGG16</option>
                </select>
              </div>
              <div class="form-group">
                  <label for="url" class="form-label">Learning Rate</label>
                  <input name="url" type="text" class="form-control shadow py-2 mb-4 bg-body rounded" id="url" placeholder="input learning rate here" required>
              </div>
              <div class="form-group">
                <label for="label" class="form-label">Optimizer</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Adam</option>
                    {{-- <option value="1">Adam</option> --}}
                </select>
            </div>
            </form>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary py-2 rounded-pill" data-bs-dismiss="modal">Close</button>
            {{-- <button role="button" class="btn btn-primary py-2 rounded-pill" href="{{ route('dashboard') }}">Submit</button> --}}
            <div data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <a class="btn btn-primary py-2 rounded-pill" href="{{ route('result-project') }}">Submit</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection