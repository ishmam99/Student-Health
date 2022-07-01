@extends('layouts.fixed')

@section('title', 'Investment package')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Investment package</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Investment package</li>
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
          Investment package
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>SL</th>
              <th>Package</th>
              <th>Money Return</th>
              <th>Accural Days</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($invests as $invest)
            <tr>
              <td>{{ $loop->iteration + $invests->firstItem() - 1 }}</td>
              <td>{{ $invest->name }}</td>
              <td><b>{{ $invest->money_return }} %</b></td>
              <td>{{ $invest->accrual_days }}</td>
              <td>{{ $invest->amount }}</td>
              <td>
                  <div class="form-group">
                      <input type="hidden" name="status" value="0">
                      <div class="custom-control custom-switch">

                          <input type="checkbox" disabled="disabled" name="status"
                              class="custom-control-input" id="customSwitch1"
                              {{ $invest->status == 1 ? 'checked' : '' }}>
                          <label class="custom-control-label" for="customSwitch1"></label>
                      </div>
                  </div>
              </td>
              <td>
                <a href="{{ route('invest.edit', $invest->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <form action="{{ route('invest.destroy', $invest->id) }}" method="post" id="video_delete_form">
                  @csrf
                  @method('DELETE')
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      <div class="text-end">{{ $invests->links() }}</div> 
      </div>
    </div>
  </div>
</section>
@endsection