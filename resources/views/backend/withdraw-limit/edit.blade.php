@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Withdraw Limit Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">home</a></li>
                        <li class="breadcrumb-item active">withdraw limit</li>
                        <li class="breadcrumb-item active">edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="p-5 card col elevation-2">
                <div class="row p-3">
                    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                        <form action="{{ route('withdraw-limit.update', $withdrawLimit->id) }}" method='post'
                            id='WithdrawLimitForm'>
                            @csrf
                            @method('PUT')
                            <div class="col-lg-12 col-sm-12 ">
                                <label for="">Amount</label>
                                <input type="number" name="amount" value="{{ $withdrawLimit->amount }}"
                                    class='form-control'>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                                <br>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <button type="submit" id='saveWithdrawLimit' class='btn btn-success'>Update</button>
                                <a href="{{ route('withdraw-limit.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop
