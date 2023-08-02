@extends('layouts.user_type.auth')

@section('content')
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> An error occurred while creating the project. Please check your input and try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container-xxl my-5">
        <div class="col-12">
            <h6 class="text-center text-uppercase fs-4">Create your new projects</h6>
            <form action="{{ route('create.store') }}" method="post" enctype="multipart/form-data" class="mx-6">
                @csrf
                <div class="row mt-5">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="name" class="form-label">Project Name</label>
                            <input name="title" type="text" class="form-control shadow py-2 mb-4 bg-body rounded @error('title') is-invalid @enderror" id="name" placeholder="Enter your project name" required value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bucket_name" class="form-label">Bucket Name</label>
                            <input name="bucket_name" type="text" class="form-control shadow py-2 mb-4 bg-body rounded @error('bucket_name') is-invalid @enderror" id="bucket_name" placeholder="Input Bucket Name here" required value="{{ old('bucket_name') }}">
                            @error('bucket_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="label" class="form-label">Label</label>
                            <input name="label" type="text" data-role="tagsinput" value="Hot Beauty,Inata Agrihoti,Ciko,Pilar" class="form-control shadow py-2 mb-4 bg-body rounded @error('label') is-invalid @enderror" id="label" placeholder="Enter your label here" value="{{ old('label') }}">
                            @error('label')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="region" class="form-label">Input Region</label>
                            <input name="region" type="text" class="form-control shadow py-2 mb-4 bg-body rounded @error('region') is-invalid @enderror" id="region" placeholder="Input Region here" required value="{{ old('region') }}">
                            @error('region')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="url_endpoint" class="form-label">Input URL</label>
                            <input name="url_endpoint" type="url" class="form-control shadow py-2 mb-4 bg-body rounded @error('url_endpoint') is-invalid @enderror" id="url_endpoint" placeholder="Input URL here" pattern="https://.*" size="30" required value="{{ old('url_endpoint') }}">
                            @error('url_endpoint')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="access_key" class="form-label">Access Key</label>
                            <input name="access_key" type="text" class="form-control shadow py-2 mb-4 bg-body rounded @error('access_key') is-invalid @enderror" id="access_key" placeholder="Input Access Key here" value="{{ old('access_key') }}">
                            @error('access_key')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="secret_access_key" class="form-label">Secret Access Key</label>
                            <input name="secret_access_key" type="text" class="form-control shadow py-2 mb-4 bg-body rounded @error('secret_access_key') is-invalid @enderror" id="secret_access_key" placeholder="Input Secret Access Key here" value="{{ old('secret_access_key') }}">
                            @error('secret_access_key')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn bg-gradient-success w-30 mt-4 mb-0">Save Project</button>
                </div>
            </form>
        </div>
    </div>
@endsection
