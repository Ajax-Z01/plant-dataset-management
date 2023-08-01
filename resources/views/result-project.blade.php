@extends('layouts.user_type.auth')

@section('content')
{{-- <div class="container-xxl my-5">
    <div class="col-12">
        <h6 class="text-center text-uppercase fs-4">training data result :</h6>
        <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Sales overview</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2021
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
    </div>
</div> --}}
<h6 class="text-center text-uppercase fs-4 my-3">setup project</h6>

<div class="mx-6">
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
            <label for="epoch" class="form-label">Epoch</label>
            <input name="epoch" type="text" class="form-control shadow py-2 mb-4 bg-body rounded" id="epoch" placeholder="input learning rate here" required>
        </div>
      </form>
    </div>
    <div class="text-center">
      <button type="submit" class="btn bg-gradient-success w-30 mt-4 mb-0">Submit</button>
    </div>
  </form>
</div>


@endsection