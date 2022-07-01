@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Package Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Package</li>
                        <li class="breadcrumb-item active">{{ $package->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-white border-rounded p-3 ">
        <div class="row">
            <div class="col">
                <h2 class="mb-4">Package Name: {{ $package->name }}</h2>
            </div>
            <div class="col-1 text-end pt-2">
                <h5><a href="{{ route('package.index') }}">Back</a></h5>
            </div>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 50%">tasks</td>
                    <td>{{ $package->tasks }}</td>
                </tr>
                <tr>
                    <td style="width: 50%">cost</td>
                    <td>{{ $package->cost }}</td>
                </tr>
                <tr>
                    <td style="width: 50%">minimum withdraw amount</td>
                    <td>{{ $package->minimum_withdraw_amount }}</td>
                </tr>
                <tr>
                    <td style="width: 50%">ads period 1 price</td>
                    <td>{{ $package->ads_period_1_price }}</td>
                </tr>
                <tr>
                    <td style="width: 50%">ads period 2 price</td>
                    <td>{{ $package->ads_period_2_price }}</td>
                </tr>
                <tr>
                    <td style="width: 50%">ads period 3 price</td>
                    <td>{{ $package->ads_period_3_price }}</td>
                </tr>
                <tr>
                    <td style="width: 50%">ads period 4 price</td>
                    <td>{{ $package->ads_period_4_price }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>@if ($package->status == 1) On @else off @endif</td>
                </tr>
            </tbody>
        </table>
    </section>
@stop
