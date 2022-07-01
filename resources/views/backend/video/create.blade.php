@extends('layouts.fixed')

@section('title','Videos')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add Video</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Video</li>
            <li class="breadcrumb-item active">Add</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Add New Video
          </div>
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{route('video.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="thumbnail">Thumbnail</label>
              <input type="file" name="thumbnail" id="thumbnail" class="form-control">
              <small>maximum image size 1mb.</small>
            </div>

            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="form-group">
              <label for="link">Youtube Link</label>
              <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}">
            </div>

            <div class="form-group">
              <input type="hidden" name="status" value="0">
              <div class="custom-control custom-switch">
                <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1" checked>
                <label class="custom-control-label" for="customSwitch1">Status</label>
              </div>
            </div>

            <button type="submit" class='btn btn-primary'>Save Video</button>
          </form>
        </div>
      </div>
    </div>
  </section>
@stop
