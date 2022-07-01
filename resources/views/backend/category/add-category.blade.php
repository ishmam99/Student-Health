@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
            <li class="breadcrumb-item active">Create/View</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                Create Category
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
              <form action="{{ route('category.store') }}" method='post' enctype='multipart/form-data' id='CategoryForm'>
                @csrf
                <div class="form-group">
                  <label for="name">Category Name <span class="text-danger"><sup>*</sup></span></label>
                  <input type="text" name="name" id="name" value="{{ old('name') }}" class='form-control' required>
                  @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="image" class="control-label">image</label>
                  <input type="file" name="image" id="image" class="form-control">
                  @if ($errors->has('image'))
                    <span class="help-block">
                      <strong>{{ $errors->first('image') }}</strong>
                    </span>
                  @endif
                </div>
                <button type="submit" value='SAVE Category' id='saveCategory' class='btn btn-primary'>SAVE Category</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                Category List
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="CategoryTable">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                    <tr>
                      <td>{{ $loop->iteration + $categories->firstItem() - 1 }}</td>
                      <td>{{ $category->name }}</td>
                      <td>
                        @if($category->hasMedia('image'))
                          <img src="{{ asset($category->getFirstMediaUrl('image')) }}" alt="no image" style="height: 60px; width: 60px;">
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-info edit"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger erase" data-id="{{ $category->id }}" onclick="return confirm('Are you sure?')" href="{{ route('category.destroy', $category->id) }}"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="text-end">{{ $categories->links() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
