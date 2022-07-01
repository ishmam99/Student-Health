@extends('layouts.fixed')

@section('title', 'Approve Withdraw')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Approve Withdraw</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">home</a></li>
                        <li class="breadcrumb-item active">withdraw approve</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="p-5 card col elevation-2">
                <form action="{{ route('user-invest.withdraw.status', $invest->id) }}" method='post' <div class="row p-3">
                    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                        @csrf
                        @method('PUT')
                        <div class="binanceId mb-3">
                            <h4>Binance Id: {{ $invest->binance_id }}</h4>
                        </div>
                        <div class="mb-1">
                            <div class="row">
                                <div class="col">
                                    <h5>User Name: {{ $invest->name }}</h5>
                                </div>
                                <div class="col">
                                    <h5 class="d-flex">Package Amount&nbsp;:&nbsp;<p id='packageAmountId'>{{ $invest->invest_amount }}</p>&nbsp;tk
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5>Money Return : {{ $invest->money_return }} %</h5>
                        </div>
                        <div class="mb-4 ">
                            <h5>Profit Amount</h5>
                        </div>
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <label for="">Percentage</label>
                                    <input type="number" class="form-control" oninput="profitByPercentage()" name="percentage" id="percentageId" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="">Return Money</label>
                                    <input type="number" class="form-control" name="calculation" id="profit_amount_id" oninput="profitByAmount()" aria-describedby="profitId" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 ">
                            <label for="">Amount</label>
                            <input type="number" name="profit_amount" class='form-control'>
                            @if ($errors->has('profit_amount'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('profit_amount') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                        <input type="hidden" name="withdraw_status" value="{{ App\Models\Invest::WITHDRAWAPPROVED }}">
                        <div class="col-md-12 col-xs-12">
                            <button type="submit" id='saveWithdrawLimit' class='btn btn-success'>Approve</button>
                            <a href="{{ route('user-invest.withdraw.list') }}" class="btn btn-danger">Back</a>
                        </div>

                    </div>
                    <div class="col mt-5">
                        <h2>Prof Document</h2>
                        <a href="{{ setImage($invest->prove_document, '/public/invest') }}"><img width="500px" src="{{ setImage($invest->prove_document, '/public/invest') }}"></a>
                    </div>
                </form>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('script')
    <script>
        let packageAmount = document.getElementById('packageAmountId').innerHTML;
        const profitByPercentage = (event) => {
            const price = document.getElementById("percentageId").value;
            document.getElementById("profit_amount_id").value = (packageAmount / 100) * price;
        }

        const profitByAmount = event => {
            const price = document.getElementById("profit_amount_id").value;
            document.getElementById("percentageId").value = (price * 100) / packageAmount;
        }
    </script>
@endpush
