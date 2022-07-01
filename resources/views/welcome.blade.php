@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard </a></li>
            <li class="breadcrumb-item"> <a href=""><button class="btn btn-sm btn-success mr-2"><i class="fa fa-edit"> </i></button></a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>10</h3>
              <p>Total Users</p>
            </div>
          </div>
        </div>
       
        <div class="col-lg-4 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>5</h3>
              <p>Invest Withdraw Requests</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>6</h3>
              <p>Subscription Withdraw Requests</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
