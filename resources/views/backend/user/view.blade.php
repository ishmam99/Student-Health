@extends('layouts.fixed')

@section('title','Dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Users Information</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
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
            <tbody>
              <tr>
                <td><b>Image:</b></td>
                <td><img src="{{ asset('storage/app/'.$user->image) }}" alt="User Image" style="max-height: 60px"></td>
                <td><b>Nid:</b></td>
                <td><img src="{{ asset('storage/app/'.$user->nid) }}" alt="User Image" style="max-height: 60px"></td>
                <td><b>Nid Back:</b></td>
                <td><img src="{{ asset('storage/app/'.$user->nid_back) }}" alt="User Image" style="max-height: 60px"></td>
              </tr>
              <tr>
                <td><b>User Name:</b></td>
                <td>{{ $user->uid }}</td>
                <td><b>Father Name:</b></td>
                <td>{{ $user->father }}</td>
                <td><b>Mother Name:</b></td>
                <td>{{ $user->mother }}</td>
              </tr>
              <tr>
                <td><b>Email:</b></td>
                <td>{{ $user->email }}</td>
                <td><b>Mobile:</b></td>
                <td>{{ $user->mobile }}</td>
                <td><b>Date Of Birth:</b></td>
                <td>{{ $user->dob }}</td>
              </tr>
              <tr>
                <td><b>Type:</b></td>
                <td>{{ $user->type }}</td>
                <td><b>Mobile:</b></td>
                <td>{{ $user->mobile }}</td>
                <td><b>Referred By:</b></td>
                <td>{{ $user->referredBy != null ? $user->referredBy->uid : '-' }}</td>
              </tr>
              <tr>
                <td><b>Division:</b></td>
                <td>{{ $user->division }}</td>
                <td><b>District:</b></td>
                <td>{{ $user->district }}</td>
                <td><b>Post Code:</b></td>
                <td>{{ $user->post_code }}</td>
              </tr>
              <tr>
                <td><b>PS:</b></td>
                <td colspan="5">{{ $user->ps }}</td>
              </tr>
              <tr>
                <td><b>Bkash:</b></td>
                <td>{{ $user->bkash }}</td>
                <td><b>Rocket:</b></td>
                <td>{{ $user->rocket }}</td>
                <td><b>Nagad:</b></td>
                <td>{{ $user->nagad }}</td>
              </tr>
              <tr>
                <td><b>Bank Ac:</b></td>
                <td>{{ $user->bank_ac }}</td>
                <td><b>Bank Name:</b></td>
                <td>{{ $user->bank_name }}</td>
                <td><b>Branch Name:</b></td>
                <td>{{ $user->branch_name }}</td>
              </tr>
              <tr>
                <td><b>Created At:</b></td>
                <td>
                  {{date('d/m/y h:i A', strtotime($user->created_at))}}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@stop

