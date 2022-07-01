@extends('layouts.fixed')

@section('title', 'Withdraw')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">User's Withdraw Request's</h4>
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
                        Withdraw request list
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Invest At</th>
                                <th>Accrual Days</th>
                                <th>Amount</th>
                                <th>Package</th>
                                <th>Proof Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invests as $invest)
                                <tr>
                                    <td>{{ $invest->uid }}</td>
                                    <td>{{ $invest->name }}</td>
                                    <td>{{ date('d/M/y', strtotime($invest->created_at)) }}</td>
                                    <td>{{ daysCount($invest->approved_at) }}</td>
                                    <td>{{ $invest->invest_amount }}</td>
                                    <td>{{ $invest->package_name }}</td>
                                    <td>
                                        <a href="{{ setImage($invest->prove_document, '/public/invest') }}"><img
                                                width="100px"
                                                src="{{ setImage($invest->prove_document, '/public/invest') }}"></a>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ route('user-invest.approve.show', $invest->id) }}"
                                                        class="btn btn-primary">Approve</a>
                                                </div>
                                                <div class="col">
                                                    <form action="{{ route('user-invest.withdraw.status', $invest->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="withdraw_status"
                                                            value="{{ App\Models\Invest::WITHDRAWCANCEL }}">
                                                        <button class="btn btn-danger" type="submit">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
