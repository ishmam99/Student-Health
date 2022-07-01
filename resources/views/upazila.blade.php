@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">উপজেলা ভিত্তিক রিপোর্ট</h1>
        </div>
       

      </div>
    </div>
  </div>
  <section class="content">
    <div class="container">
     <div class="card col-8">
      <div class="p-5 m-5 text-center">
        <h4 class="p-3">উপজেলা নির্বাচন করুন</h4>
        <form action="{{route('upazila.report')}}" method="POST">
          @csrf
      <select name="upazila" class="form-control" id="upazila">
        @foreach ($upazilas as $upazila)
            <option value="{{$upazila->name}}">{{$upazila->name}}</option>
        @endforeach
      </select>
      <div class="col-3 float-right p-2 m-4">
      <button class="btn btn-primary">রিপোর্ট দেখুন</button>
    </div>
    </form>
      </div>
      
     </div>
    </div>
  </section>
@stop
