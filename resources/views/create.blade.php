@extends('layouts.user_type.auth')

@section('content')
    <div class="container-xxl my-5">
        <div class="col-12">
            <h6 class="text-center text-uppercase fs-4">Create your new projects</h6>
            <form action="{{ route('create.store') }}" method="post" enctype="multipart/form-data" class="mx-6">
                @csrf
                <div class="row mt-5">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="name" class="form-label">Project Name</label>
                            <input name="title" type="text" class="form-control shadow py-2 mb-4 bg-body rounded" id="name" placeholder="Enter your project name" required>
                        </div>
                        <div class="form-group">
                            <label for="label" class="form-label">Label</label>
                            <input name="label" type="text" data-role="tagsinput" value="Tanjung,Branang" class="form-control shadow py-2 mb-4 bg-body rounded" id="label" placeholder="Enter your label here">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="url_endpoint" class="form-label">Input URL</label>
                            <input name="url_endpoint" type="url" class="form-control shadow py-2 mb-4 bg-body rounded" id="url_endpoint" placeholder="Input URL here" pattern="https://.*" size="30"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="access_key" class="form-label">Access Key</label>
                            <input name="access_key" type="text" class="form-control shadow py-2 mb-4 bg-body rounded" id="access_key" placeholder="Input Access Key here">
                        </div>
                        <div class="form-group">
                            <label for="secret_access_key" class="form-label">Secret Access Key</label>
                            <input name="secret_access_key" type="text" class="form-control shadow py-2 mb-4 bg-body rounded" id="secret_access_key" placeholder="Input Secret Access Key here">
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