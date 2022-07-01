@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Withdraw</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Withdraw</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Withdraw Requests
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                {{-- <th>uid</th>
                  <th>Requested Amount</th>
                  <th>After Cost Amount</th>
                  <th>Method</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th> --}}
                                 <th>SL</th>
                                <th>User id</th>
                                <th>Binance Id</th>
                                <th>Requested Amount</th>
                                <th>Method</th>
                                <th>Requested At</th>
                                <th>User Balance</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraws as $withdraw)
                                <tr>
                                     <td>{{ $loop->iteration + $withdraws->firstItem() - 1 }}</td>
                                   
                                    <td>{{ $withdraw->user->uid }}</td>
                                    <td onclick="copyToClipboard({{$withdraw->binance_id}})" id="link">{{ $withdraw->binance_id }} <i class="fa fa-copy text text-info"></i></td>
                                    <td>{{ $withdraw->amount }}</td>

                                    <td>{{ $withdraw->method }}</td>
                                    <td>{{ $withdraw->created_at->format('d M Y h:i A') }}</td>
                                    <td>{{ $withdraw->user->balance }}</td>
                                    <td>
                                        @if ($withdraw->status == App\Models\Withdraw::WITHDRAWPENDING)
                                            <span class="text-primary">Pending</span>
                                        @elseif($withdraw->status == App\Models\Withdraw::WITHDRAWAPPROVE)
                                            <span class="text-success">Accepted</span>
                                        @else
                                            <span class="text-danger">Canceled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($withdraw->status == 0)
                                            <div class="d-flex">
                                                <div class="approve mr-1">
                                                    <form action="{{ route('withdraw.update', $withdraw->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status"
                                                            value="{{ App\Models\Withdraw::WITHDRAWAPPROVE }}">
                                                        <button type="submit" class="btn btn-success"
                                                            onclick="return confirm('Are you sure?')"><i
                                                                class="fa fa-check-circle"></i></button>
                                                    </form>
                                                </div>
                                                <div class="cancel">
                                                    <form action="{{ route('withdraw.update', $withdraw->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status"
                                                            value="{{ App\Models\Withdraw::WITHDRAWCANCEL }}">
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')"><i
                                                                class="fa fa-times"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   <div class="text-end">{{ $withdraws->links() }}</div> 
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  
@endsection
  <script>
  
    function copyToClipboard(id) {
      const el = document.createElement('textarea');
       el.value = id;
      document.body.appendChild(el);
      el.select();
       $('#copy-button').trigger('copied', ['Copied!']);
      document.execCommand('copy');
      document.body.removeChild(el);
    }
  </script>