@extends('layouts.fixed')

@section('title','Dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Category Edit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="p-5 card col elevation-2">
        <div class="row">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
        <div class="row p-3">
          <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <form action="{{route('category.update', $category->id)}}" method='post'
                  enctype='multipart/form-data' id='CategoryForm'>
              @csrf
              <div class="col-lg-12 col-sm-12 {{$errors->has('name') ? 'has-error' : ''}}">
                <label for="">Category Name <span
                    class="text-danger"><sup>*</sup></span></label>
                <input type="text" name="name" value="{{$category->name}}" class='form-control'
                       placeholder='Ex: Mikimoto'>
                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
                <br>
              </div>

              <div class="col-lg-12 col-sm-12 {{$errors->has('image') ? 'has-error' : ''}}">
                <label for="" class="control-label">Cover image</label>
                <input type="file" name="image" class="form-control">
                @if ($errors->has('image'))
                  <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                  </span>
                @endif
                <br>
              </div>


              <div
                class="col-lg-12 col-sm-12 {{$errors->has('description') ? 'has-error' : ''}}">
                <label for="" class="control-label">Description</label>
                <textarea name="description" class='form-control'
                          placeholder='Category Details....'>{{$category->description}}</textarea>
                @if ($errors->has('description'))
                  <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>

              <div class="col-md-12 col-xs-12">
                <br>
              </div>

              <div class="col-md-12 col-xs-12">
                <button type="submit" value='Update Category' id='saveCategory' class='btn btn-primary'>Update Category</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@stop
