@extends('layouts.fixed')

@section('title','Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Ranks</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Ranks</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @if(Session::has('success'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
      @endif

      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">All Ranks</h5>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>SL</th>
                <th>Rank</th>
                <th>Total IDs</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ranks as $rank)
                <tr>
                  <td>{{ $loop->iteration + $ranks->firstItem() - 1 }}</td>
                  <td>{{ $rank->name }}</td>
                  <td> {{ $rank->total_id }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
         <div class="text-end">{{ $ranks->links() }}</div> 
        </div>
      </div>
    </div>
  </section>
@stop
