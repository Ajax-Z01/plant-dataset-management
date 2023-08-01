@extends('layouts.user_type.auth')

@section('content')
  <div class="container-fluid p-4">
    <div class="card">
      <div class="row">
        <div class="col-7">
          <div class="card-body p-2">
            <ul class="list-group m-3" style="color: #285430">
              <li class="list-group-item border-0 ps-0 pt-0 text-lg"><strong style="color: #285430">
                <span><i class="fas fa-tags pe-2" style="color: #285430 ;"></i></span>
                Project name :</strong> &nbsp; {{ $project->title }}
              </li>
            </ul>
          {{-- <div class="row">
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
          </div> --}}
        </div>
      </div>
      <div class="col-5">
        <div class="d-flex justify-content-end p-3">
          <a href="{{ url('result-project') }}" class="btn bg-gradient-success btn-sm my-2">Training Data</a>
        </div>
      </div>
    </div>
  </div>
 
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-9 col-lg-12" id="col9Div">
        <div class="card">
          <div class="card-body">
            <div class="row row-cols-6">
              @foreach ($files as $file)
                @php
                    $fileUrl = $file->url;
                    $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                @endphp
        
                @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                    <div class="col px-2 py-4">
                        <div class="card text-center">
                            <img src="{{ $fileUrl }}" class="card-img-top" alt="image" />
                            <div class="card-body">
                                <h5 class="card-title text-sm">Label</h5>
                                <a href="#" class="btn btn-danger btn-sm px-3" style="background-color: #285430" onclick="toggleColumns('{{ $fileUrl }}')">View</a>
                                <a href="#" class="btn btn-danger btn-sm px-3" style="background-color: #850000">Delete</a>
                            </div>
                        </div>
                    </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="col-3 d-none" id="col3Div">
        <div class="card">
          <h5 class="text-center m-3">Display Image</h5>
          <img class="mx-auto d-block py-4" id="image" src="" alt="">
          <div class="p-3">
            <select class="form-select" aria-label="Default select example">
              @foreach ($labels as $label)
              <option selected>{{ $label->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="d-flex justify-content-center pb-2">
            <div class="button">
              <a class="btn bg-gradient-success btn-sm py-1 px-3 my-2 fs-6 rounded-pill me-2">save</a>
              <a class="btn btn-secondary btn-sm py-1 px-3 my-2 fs-6 rounded-pill" href="">close</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- <div class="card mb-4">
  <div class="card-header pb-0">
    <h6>Datasets table</h6>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Images</th>
            <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">File Name</th>
            <th class="text-secondary opacity-7"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($files as $file)
            @php
                $fileUrl = $file->url;
                $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
            @endphp

            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
              <tr>
                <td>
                  <img src="{{ $fileUrl }}" class="avatar ms-4" alt="image">
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $file->filename }}</p>
                </td>
                <td class="align-middle text-center">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-sm" onclick="show('{{ $fileUrl }}')">
                    View
                  </a>
                </td>
                <td class="align-middle text-center">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Edit user">
                    Delete
                  </a>
                </td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div> --}}

  {{-- <div class="row row-cols-7 g-2 g-lg-3 px-4">
    @foreach ($files as $file)
        @php
            $fileUrl = $file->url;
            $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
        @endphp

        @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) Check if the file has an image extension
            <div class="col px-2 py-4">
                <div class="card text-center">
                    <img src="{{ $fileUrl }}" class="card-img-top" alt="image" />
                    <div class="card-body">
                        <h5 class="card-title text-sm">Card title</h5>
                        <a href="#" class="btn btn-danger mt-2" style="background-color: #285430" onclick="show('{{ $fileUrl }}')">Show</a>
                        <a href="#" class="btn btn-danger mt-2" style="background-color: #850000">Delete</a>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
  </div> --}}

@endsection