@extends('layouts.fixed')

@section('title','Investment')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Investment</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Investment</li>
          <li class="breadcrumb-item active">Edit</li>
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
          Edit In
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

        <form action="{{route('invest.update', $invest->id)}}" method="post">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="package">Package Name</label>
            <input type="text" name="name" id="package" class="form-control" value="{{ old('name', $invest->name) }}">
          </div>
          <div class="form-group">
            <label for="money_return">Money Return</label>
            <input type="number" name="money_return" id="money_return" class="form-control" value="{{ old('money_return', $invest->money_return) }}">
          </div>
          <div class="form-group">
            <label for="accrual_days">Accural Days</label>
            <input type="number" name="accrual_days" id="accrual_days" class="form-control" value="{{ old('accrual_days', $invest->accrual_days) }}">
          </div>
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $invest->amount) }}">
          </div>
         
          <div class="form-group">
              <input type="hidden" name="status" value="0">
              <div class="custom-control custom-switch">
                  <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1"
                      {{ $invest->status == 1 ? 'checked' : '' }}>
                  <label class="custom-control-label" for="customSwitch1">Status</label>
              </div>
          </div>
      
          <button type="submit" class='btn btn-primary'>Update Investment</button>
        </form>
      </div>
    </div>
  </div>
</section>
@stop