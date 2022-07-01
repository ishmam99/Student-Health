@extends('layouts.fixed')

@section('title','Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Category Edit</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
            <li class="breadcrumb-item active">Edit</li>
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
            Category Edit
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

          @if($category->hasMedia('image'))
            <img src="{{ asset($category->getFirstMediaUrl('image')) }}" alt="No image" style="height: 100px" class="mb-4">
          @endif

          <form action="{{route('category.update', $category->id)}}" method='post' enctype='multipart/form-data' id='CategoryForm'>
            @csrf
            <div class="{{$errors->has('name') ? 'has-error' : ''}}">
              <label for="name">Category Name <span class="text-danger"><sup>*</sup></span></label>
              <input type="text" name="name" id="name" value="{{$category->name}}" class='form-control'>
              @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
              <br>
            </div>

            <div class="{{$errors->has('image') ? 'has-error' : ''}}">
              <label for="image" class="control-label">Image</label>
              <input type="file" name="image" id="image" class="form-control">
              @if ($errors->has('image'))
                <span class="help-block">
                  <strong>{{ $errors->first('image') }}</strong>
                </span>
              @endif
              <br>
            </div>
            <button type="submit" value='Update Category' id='saveCategory' class='btn btn-primary'>Update Category</button>
          </form>
        </div>
      </div>
    </div>
  </section>
@stop
