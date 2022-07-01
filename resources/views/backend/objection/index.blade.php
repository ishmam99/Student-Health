@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Objection</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">objections</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container">
            @if (Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Request Objections</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>User</th>
                                <th>Objection</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($objections as $objection)
                                <tr>
                                    <td>{{ $loop->iteration + $objections->firstItem() - 1 }}</td>
                                    <td>{{ $objection->user->name }}</td>
                                    <td>{{ $objection->objection }}</td>
                                    <td>{{ $objection->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="approve mr-1">
                                                <form action="{{ route('objection.update', $objection->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status"
                                                        value="{{ App\Models\Objection::APPROVE }}">
                                                    <button class="btn btn-primary" type="submit">Approve</button>
                                                </form>
                                            </div>
                                            <div class="cancel">
                                                <form action="{{ route('objection.update', $objection->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status"
                                                        value="{{ App\Models\Objection::CANCEL }}">
                                                    <button class="btn btn-danger" type="submit">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex">

                </div>
                <div class="d-flex justify-content-end mr-3">{{ $objections->links() }}</div>
            </div>
        </div>
    </section>
@stop
