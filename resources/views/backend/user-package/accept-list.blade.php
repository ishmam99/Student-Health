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
                                <th>SL</th>
                                <th>User Name</th>
                                <th>Approve At</th>
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
                                     <td>{{ $loop->iteration + $allSubscribers->firstItem() - 1 }}</td>
                                    <td>{{ $subscriber->name }}</td>
                                    <td>{{ $userPackage->pivot->updated_at->diffForHumans() }}</td>
                                    <td>{{ $userPackage->name }}</td>
                                    <td>{{ $userPackage->pivot->transaction_id }}</td>
                                    <td><a href="{{ setImage($userPackage->pivot->prove_document, '/public/package') }}"><img
                                                width="200px" src="{{ setImage($userPackage->pivot->prove_document, '/public/package') }}"></a>
                                    </td>
                                    <td>
                                        @if ($userPackage->pivot->status == App\Models\PackageUser::APPROVE)
                                            <div class="text-success">Request Approved</div>
                                        @elseif ($userPackage->pivot->status==App\Models\PackageUser::CANCEL)
                                            <div class="text-danger">Request Cancel</div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                  <div class="text-end">{{ $allSubscribers->links() }}</div> 
                </div>
            </div>
        </div>
    </section>
@endsection
