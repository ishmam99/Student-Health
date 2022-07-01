@extends('layouts.fixed')

@section('title', 'Size-Color')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Size/Color</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Size/Color</li>
            <li class="breadcrumb-item active">View</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                Sizes
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="CategoryTable">
                <thead>
                  <tr>
                    <th width="100">SL</th>
                    <th>Size</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sizes as $size)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $size->name }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Colors</div>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="CategoryTable">
                <thead>
                  <tr>
                    <th width="100">SL</th>
                    <th>Color</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($colors as $color)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $color->name }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
