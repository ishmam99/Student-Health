@extends('layouts.fixed')

@section('title','Dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Transactions - {{ $page }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Transactions</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row p-3">

        <!-- /.row -->
        <!-- Main row -->
        <div class="card col">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>SL</th>
                <th>uid</th>
                <th>Amount</th>
                <th>Method</th>
                <th>From</th>
                <th>To</th>
                <th>Transaction ID</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach($records as $key => $item)
                <tr>
                  <td>{{ $loop->iteration + $ranks->firstItem() - 1 }}</td>
                  <td>{{ $item->user->uid }}</td>
                  <td>{{ $item->amount }}</td>
                  <td>{{ $item->method }}</td>
                  <td>{{ $item->from }}</td>
                  <td>{{ $item->to }}</td>
                  <td>{{ $item->txn_id }}</td>
                  <td>{{ $item->status }}</td>
                  <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
                  <td>
                    @if($item->status == "pending" && $item->type == "deposit")
                      <form action="{{ route('backend.transaction.status.paid',$item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-success"><i class="fa fa-check">&nbsp;Recieved</i></button>
                      </form>
                    @endif
                    @if($item->status == "pending" && $item->type == "withdraw")
                      <a href="{{ route('backend.transaction.status.paid',$item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check">&nbsp;Accepted</i></a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
             <div class="text-end">{{ $records->links() }}</div> 
          </table>
        </div>
      </div><!-- /.row (main row) -->
      <div class="row px-3">
        <div class="col">
          @php
            $data = $records
          @endphp
          <span class="pull-right">
            <ul class="pagination">
              <li class=" @if($data->appends(request()->query())->currentPage() == 1) disabled @endif">
                <a class="" href="{{ $data->appends(request()->query())->url(1) }}">← First</a>
              </li>

              <li class=" @if($data->appends(request()->query())->currentPage() == 1) disabled @endif">
                <a class="" href="{{ $data->appends(request()->query())->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a>
              </li>
              @foreach(range(1, $data->appends(request()->query())->lastPage()) as $i)
                @if($i >= $data->appends(request()->query())->currentPage() - 4 && $i <= $data->appends(request()->query())->currentPage() + 4)
                  @if ($i == $data->appends(request()->query())->currentPage())
                    <li class="active"><span>{{ $i }}</span></li>
                  @else
                    <li><a href="{{ $data->appends(request()->query())->url($i) }}">{{ $i }}</a></li>
                  @endif
                @endif
              @endforeach

              <li class=" @if($data->appends(request()->query())->lastPage() == $data->appends(request()->query())->currentPage()) disabled @endif">
                <a class="" href="{{ $data->appends(request()->query())->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a>
              </li>
              <li class=" @if($data->appends(request()->query())->lastPage() == $data->appends(request()->query())->currentPage()) disabled @endif">
                <a class="" href="{{ $data->appends(request()->query())->url($data->lastPage()) }}">Last →</a>
              </li>
            </ul>

          </span>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@stop

