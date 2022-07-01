@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">ক্যালেন্ডার বর্ষ ভিত্তিক রিপোর্ট</h1>
        </div>
       

      </div>
    </div>
  </div>
  <section class="content">
    <div class="container">
     <div class="card col-8">
      <div class="p-5 m-5 text-center">
        <h4 class="p-3">ক্যালেন্ডার বর্ষ নির্বাচন করুন</h4>
        <form action="{{route('calendar.report')}}" method="POST">
          @csrf
 <select name="year" class="form-control text-center" id="year" >
        @for($year=2025;$year>2005;$year--)
            <option value="{{en2bn($year)}}">{{en2bn($year)}} </option>
        @endfor
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
