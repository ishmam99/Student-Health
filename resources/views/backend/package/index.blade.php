@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Packages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Packages</li>
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
            @if (Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">All Packages</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Package</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $loop->iteration + $packages->firstItem() - 1 }}</td>
                                    <td>{{ $package->name }}</td>
                                    <td> {{ $package->cost }} TK</td>
                                    <th>
                                        <div class="form-group">
                                            <input type="hidden" name="status" value="0">
                                            <div class="custom-control custom-switch">

                                                <input type="checkbox" disabled="disabled" name="status"
                                                    class="custom-control-input" id="customSwitch1"
                                                    {{ $package->status == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customSwitch1"></label>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <a href="{{ route('package.edit', $package->id) }}"
                                            class="btn btn-primary">Update</a>
                                        <a href="{{ route('package.show', $package->id) }}"
                                            class="btn btn-success">Show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  <div class="text-end">{{ $packages->links() }}</div> 
                </div>
            </div>
        </div>
    </section>
@stop
