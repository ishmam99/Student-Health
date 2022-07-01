@extends('layouts.fixed')

@section('title', 'Withdraw Limit')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Withdraw Limit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">withdraw-limit</li>
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
                        Withdraw Limits
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraw_limits as $limit)
                                <tr>
                                     <td>{{ $loop->iteration + $withdraw_limits->firstItem() - 1 }}</td>
                                    <td>{{ $limit->amount }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="approve mr-1">
                                                <a href="{{ route('withdraw-limit.show', $limit->id) }}"
                                                    class="btn btn-success"><i class="fa fa-check-circle"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                 <div class="text-end">{{ $withdraw_limits->links() }}</div> 
                </div>
            </div>
        </div>
    </section>
@endsection
