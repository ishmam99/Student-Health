@extends('layouts.fixed')

@section('title','Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Clubs</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Clubs</li>
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
          <h5 class="mb-0">All Clubs</h5>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>SL</th>
                <th>Club</th>
                <th>Minimum Referral</th>
                <th>Club Fund</th>
{{--                <th>Action</th>--}}
              </tr>
            </thead>
            <tbody>
              @foreach($clubs as $club)
                <tr>
                  <td>{{ $loop->iteration + $clubs->firstItem() - 1 }}</td>
                  <td>{{ $club->name }}</td>
                  <td> {{ $club->minimum_referral }}</td>
                  <td> {{ $club->fund }} TK</td>
                  {{--<td>
                    <a href="{{route('club.edit',$club->id)}}" class="btn btn-sm btn-info edit">
                      <i class="fas fa-edit"></i>
                    </a>
                  </td>--}}
                </tr>
              @endforeach
            </tbody>
          </table>
         <div class="text-end">{{ $clubs->links() }}</div>
        </div>
      </div>
    </div>
  </section>
@stop
