@extends('layouts.fixed')

@section('title', 'User Approve')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">User Package Pending Requests</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">approve</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        History List
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Created At</th>
                                <th>Package Name</th>
                                <th>Transaction ID</th>
                                <th>Prove Document</th>
                                <th>Action/Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allSubscribers as $subscriber)
                            @foreach ($subscriber->subscribePackage as $userPackage)
                                    <tr>
                                        <td>{{ $subscriber->name }}</td>
                                        
                                        <td>{{ date('d/M/y', strtotime($userPackage->pivot->created_at)) }}</td>
                                        <td>{{ $userPackage->name }}</td>
                                        <td>{{ $userPackage->pivot->transaction_id }}</td>
                                        <td><a href="{{ setImage($userPackage->pivot->prove_document, '/public/package') }}"><img
                                                    width="250px"
                                                    src="{{ setImage($userPackage->pivot->prove_document, '/public/package') }}"></a>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="approve mr-1">
                                                    <form action="{{ route('user-package.update', $userPackage->pivot->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_approved"
                                                            value="{{ App\Models\PackageUser::APPROVE }}">
                                                        <button class="btn btn-primary" type="submit">Approve</button>
                                                    </form>
                                                </div>
                                                <div class="cancel">
                                                    <form action="{{ route('user-package.update', $userPackage->pivot->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_approved"
                                                            value="{{ App\Models\PackageUser::CANCEL }}">
                                                        <button class="btn btn-danger" type="submit">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
