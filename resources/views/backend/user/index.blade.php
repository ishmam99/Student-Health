@extends('layouts.fixed')

@section('title','Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
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
            Users List
          </div>
          <div class="card-tools">
            {{-- <button class="btn btn-info" data-toggle="modal" data-target="#balanceTransferModal">Send Balance</button> --}}
           <a href="{{route('user.create')}}"><button class="btn btn-success" >Add New User <i class="fa fa-plus-circle"></i> </button></a> 
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Balance</th>
                <th>Referred by</th>
               
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              @if ($user!=auth()->user())
                  
             
                <tr>
                  <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->uid }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ $user->balance }}</td>
                  <td>{{ $user->referredBy != null ? $user->referredBy->name : '-' }}</td>
                  
                  <td class="d-flex">
                    {{--<a href="{{ route('backend.user.view',$user->uid) }}" class="btn btn-primary">
                      <i class="fa fa-eye"></i>
                    </a>--}}
                    @if($user->status == 0)
                      <form action="{{ route('backend.transaction.status.paid',$tran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-success"><i class="fa fa-check">&nbsp;Accept </i></button>
                      </form>
                      <form action="{{ route('backend.user.status.cancel',$user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-danger "><i class="fa fa-times">&nbsp;Cancel </i></button>
                      </form>
                    @endif
                 
                    <a href="{{route('user.edit',$user->id)}}"><button class="btn btn-sm btn-success mr-2"><i class="fa fa-edit"> </i></button></a>
                        
                     
                      <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger "><i class="fa fa-trash"></i></button>
                      </form>
                  </td>
                </tr>
                 @endif
              @endforeach
            </tbody>
              <div class="text-end">{{ $users->links() }}</div> 
          </table>
        </div>
      </div>
    </div>
  </section>

  {{-- balance transfer modal --}}
  <div class="modal fade" id="balanceTransferModal" tabindex="-1" aria-labelledby="balanceTransferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="balanceTransferModalLabel">Transfer Balance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('user.balance.update') }}" method="post">
            @csrf

            <div class="form-group">
              <label for="user_id">Select User</label>
              <select name="user_id" id="user_id" class="form-control select2" style="width: 100%">
                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="amount">Amount</label>
              <input type="number" name="amount" id="amount" class="form-control">
            </div>

            <button type="submit" class="btn btn-info">Update Balance</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    $(function (){
      $(".select2").select2();
    });
  </script>
@endpush
