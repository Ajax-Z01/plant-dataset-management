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
                    <button type="button" class="btn bg-gradient-success btn-md my-2 mx-5" data-bs-toggle="modal" data-bs-target="#collaborator"><i class="fas fa-user pe-2" title="Edit Profile"></i><span>Add People</span></button>
                    <div class="modal fade" id="collaborator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Manage Access</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{{ route('add.collaborator', $project->id) }}" method="post" enctype="multipart/form-data">
                                        @method('POST')
                                        @csrf
                                        <label for="collaborator" class="form-label me-3">Collaborators</label>
                                        @foreach ($users as $user)
                                            <div class="px-2">
                                                <input type="checkbox" name="collaborators[]" value="{{ $user->id }}" id="collaborator_{{ $user->id }}" 
                                                {{ $project->users->contains($user->id) ? 'checked' : '' }}><label for="collaborator_{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</label>
                                            </div>
                                        @endforeach
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" style="background-color: #850000" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('result-project/' . $project->id) }}" class="btn bg-gradient-success btn-md my-2">Training Data</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mb-5">
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
                                        {{-- <form id="delete-form-{{ htmlentities($datasetIds[$loop->index]) }}" action="{{ route('delete.dataset', ['id' => $datasetIds[$loop->index]]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        </form> --}}
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

@section('scripts')
<script>
    function viewFile(fileUrlWithDatasetId) {
      // Split fileUrlWithDatasetId to get fileUrl and datasetId
      const [fileUrl, datasetId] = fileUrlWithDatasetId.split(', ');
  
      // Update the 'src' attribute of the image with the clicked fileUrl
      document.getElementById('image').src = fileUrl;
  
      // Set the selectedDatasetId to the datasetId of the clicked file
      selectedDatasetId = datasetId;
  
      // Set the form action dynamically based on the datasetId
      const form = document.getElementById('updateForm');
      const baseUrl = "{{ url('/view-project/update-label/') }}"; // Set the base URL for the action
      form.action = baseUrl + selectedDatasetId;
  
      // Toggle classes for col-9 and col-3
      const col3Div = document.getElementById('col3Div');
  
      // Check if the col3Div is hidden before toggling visibility
      if (col3Div.classList.contains('d-none')) {
          const col9Div = document.getElementById('col9Div');
          col9Div.classList.toggle('col-lg-12');
          col3Div.classList.toggle('d-none');
      }
    }
  
  
    function closeView() {
      // Reset the 'src' attribute of the image
      document.getElementById('image').src = '';
  
      // Toggle classes for col-9 and col-3
      const col9Div = document.getElementById('col9Div');
      const col3Div = document.getElementById('col3Div');
  
      col9Div.classList.toggle('col-lg-12');
      col3Div.classList.toggle('d-none');
    }
</script>
@endsection