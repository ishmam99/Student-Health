@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">New Package</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Package</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="bg-white border-rounded p-3 pt-5">
        <form action="{{ route('package.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Package Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameId" placeholder="Subscription package name">
                <small id="nameId" class="form-text text-muted">Package Name</small>
            </div>
            <div class="mb-3">
                <label for="tasks" class="form-label">Daily Total Task</label>
                <input type="number" class="form-control" name="tasks" id="tasks" aria-describedby="tasksId" placeholder="Subscription package name">
                <small id="tasksId" class="form-text text-muted">daily total task</small>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="cost" class="form-label">Subscribe Price</label>
                        <input type="text" class="form-control" name="cost" id="cost" placeholder="subscribe price">
                        <small id="helpId" class="form-text text-muted">Subscription Price package</small>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="minimum_withdraw_price" class="form-label">Minimum Withdraw Price</label>
                        <input type="text" class="form-control" name="minimum_withdraw_amount" id="minimum_withdraw_amount" placeholder="Minimum Withdraw price">
                        <small id="helpId" class="form-text text-muted">Withdraw price amount</small>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="ads_period_1_price" class="form-label">1st 50 Days</label>
                <input type="text" class="form-control" name="ads_period_1_price" id="ads_period_1_price" placeholder="1st Period Price">
            </div>
            <div class="mb-3">
                <label for="ads_period_2_price" class="form-label">2nd 50 Days</label>
                <input type="text" class="form-control" name="ads_period_2_price" id="ads_period_2_price" placeholder="2nd Pediod Price">
            </div>
            <div class="mb-3">
                <label for="ads_period_3_price" class="form-label">3rd 50 Days</label>
                <input type="text" class="form-control" name="ads_period_3_price" id="ads_period_3_price" placeholder="3rd Period Price">
            </div>
            <div class="mb-3">
                <label for="ads_period_4_price" class="form-label">4th 50 Days</label>
                <input type="text" class="form-control" name="ads_period_4_price" id="ads_period_4_price" placeholder="4th Period Price">
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="hidden" name="status" value="0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Status</label>
                        </div>
                    </div>
                </div>
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary">Create Package</button>
                </div>
            </div>
        </form>
    </section>
@stop
