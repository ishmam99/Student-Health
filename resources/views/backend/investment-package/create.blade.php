@extends('layouts.fixed')

@section('title','Investment')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create Investment Package</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Investment</li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          Add New Investment
        </div>
      </div>
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{route('invest.store')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="package">Package Name</label>
            <input type="text" name="name" placeholder="Enter package name" id="package" class="form-control" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="money_return">Money Return</label>
            <input type="number" name="money_return" placeholder="Percentage of money Return" id="money_return" class="form-control" value="{{ old('money_return') }}">
          </div>
          <div class="form-group">
            <label for="accrual_days">Accural Days</label>
            <input type="number" name="accrual_days" placeholder="Accural Days of new package" id="accrual_days" class="form-control" value="{{ old('accrual_days') }}">
          </div>
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" placeholder="Enter the package amount" class="form-control" value="{{ old('amount') }}">
          </div>
          
          <div class="form-group">
              <input type="hidden" name="status" value="0">
              <div class="custom-control custom-switch">
                  <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1">
                  <label class="custom-control-label" for="customSwitch1">Status</label>
              </div>
          </div>
      

          <button type="submit" class='btn btn-primary'>Save Investment</button>
        </form>
      </div>
    </div>
  </div>
</section>
@stop