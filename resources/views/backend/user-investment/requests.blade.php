@extends('layouts.fixed')

@section('title', 'Request list')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">Invest Request List</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">pending list</li>
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
                        Invest Request List
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Invest At</th>
                                <th>Amount</th>
                                <th>Transaction ID</th>
                                <th>Prove Document</th>
                                <th>Action/Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invests as $invest)
                                <tr>
                                    <td>{{ $invest->name }}</td>
                                    <td>{{ date('d/M/y', strtotime($invest->created_at)) }}</td>
                                    <td>{{ $invest->invest_amount }}</td>
                                    <td>{{ $invest->transaction_id }}</td>
                                    <td><a href="{{ setImage($invest->prove_document, '/public/invest') }}"><img
                                                width="100px"
                                                src="{{ setImage($invest->prove_document, '/public/invest') }}" alt=""
                                                srcset=""></a>
                                    </td>
                                    <td>
                                        @if ($invest->is_approved != App\Models\Invest::CANCEL)
                                            <div class="d-flex">
                                                <div class="approve mr-1">
                                                    <form action="{{ route('user-invest.status', $invest->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_approved"
                                                            value="{{ App\Models\Invest::APPROVE }}">
                                                        <button class="btn btn-primary" type="submit">Approve</button>
                                                    </form>
                                                </div>
                                                <div class="cancel">
                                                    <form action="{{ route('user-invest.status', $invest->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_approved"
                                                            value="{{ App\Models\Invest::CANCEL }}">
                                                        <button class="btn btn-danger" type="submit">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-danger text-bold text-center">
                                                <p>Invest Request Canceled</p>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
