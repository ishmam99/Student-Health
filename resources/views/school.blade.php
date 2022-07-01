@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">শিক্ষা প্রতিষ্ঠান ভিত্তিক রিপোর্ট</h1>
        </div>
       

      </div>
    </div>
  </div>
  <section class="content">
    <div class="container">
     <div class="card col-8">
      <div class="p-5 m-5 text-center">
        <h4 class="p-3">শিক্ষা প্রতিষ্ঠান নির্বাচন করুন</h4>
        <form action="{{route('school.report')}}" method="POST">
          @csrf
      <select name="school" class="form-control" id="school">
        @foreach ($schools as $school)
            <option value="{{$school->id}}">{{$school->name}}</option>
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
