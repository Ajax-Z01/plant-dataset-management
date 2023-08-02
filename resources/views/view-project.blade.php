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
                </div>
            </div>
            <div class="col-5">
                <div class="d-flex justify-content-end p-3">
                    <a href="{{ url('result-project/' . $project->id) }}" class="btn bg-gradient-success btn-sm my-2">Training Data</a>
                </div>
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
                                    <h5 class="card-title text-sm">{{ $file->label }}</h5>
                                    <div class="button">
                                        <button class="btn btn-danger btn-sm px-3" style="background-color: #285430" onclick="viewFile('{{ $file->url }}, {{ $datasetIds[$loop->index] }}')">View</button>
                                        <button class="btn btn-danger btn-sm px-3" style="background-color: #850000" onclick="deleteFile()">Delete</button>
                                    </div>
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
                <form id="updateForm" method="POST" class="p-3">
                    @csrf
                    @method('PUT')
                    <div class="p-3">
                      <select class="form-select" name="label_id" aria-label="Default select example">
                        @foreach ($labels as $label)
                            <option value="{{ $label->id }}">{{ $label->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="d-flex justify-content-center pb-2">
                        <div class="button">
                            <button type="submit" class="btn bg-gradient-success btn-sm py-1 px-3 my-2 fs-6 rounded-pill me-2">Save</button>
                            <a class="btn bg-gradient-danger btn-sm py-1 px-3 my-2 fs-6 rounded-pill" onclick="closeView()">Close</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
