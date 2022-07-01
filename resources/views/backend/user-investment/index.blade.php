@extends('layouts.fixed')

@section('title', 'User Approve')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">Active Invest User</h4>
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
                                <th>Invest At</th>
                                <th>Accrual Days</th>
                                <th>Amount</th>
                                <th>Transaction ID</th>
                                <th>Prove Document</th>
                                <th>Binance-Id</th>
                                <th>Money Return</th>
                                <th>Action/Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invests as $invest)
                                <tr>
                                    <td>{{ $loop->iteration + $invests->firstItem() - 1 }}</td>
                                    <td>{{ $invest->name }}</td>
                                    <td>{{ date('d/M/y', strtotime($invest->created_at)) }}</td>
                                    <td>{{ daysCount($invest->approved_at) }}</td>
                                    <td>{{ $invest->invest_amount }}</td>
                                    <td>{{ $invest->transaction_id }}</td>
                                    <td><a href="{{ setImage($invest->prove_document, '/public/invest') }}"><img width="100px" src="{{ setImage($invest->prove_document, '/public/invest') }}"></a>
                                    </td>
                                    <td>{{ $invest->binance_id }}</td>
                                    <td>{{ $invest->profit_amount }}</td>
                                    <td>
                                        @if ($invest->accrual_days < daysCount($invest->approved_at))
                                            @if ($invest->withdraw_status == App\Models\Invest::WITHDRAWAPPROVED)
                                                <div class="bg-success text-center p-2">
                                                    <p>Withdraw Status Completed</p>
                                                </div>
                                            @else
                                                <div class="bg-primary text-center p-2">
                                                    <p>Accrual days completed.</p>
                                                </div>
                                            @endif
                                        @else
                                            <div class="text-danger text-center p-2">
                                                <p>Accrual days not completed yet</p>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  {{-- <div class="text-end">{{ $invests->links() }}</div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
