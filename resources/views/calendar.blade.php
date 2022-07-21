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
          <div class="col-10 d-flex align-items-center justify-content-center">
          <div class="col-5">
          <input type="text" required class="form-control" name="year" placeholder="ক্যালেন্ডার বর্ষ" id="datepicker" />
        </div>
          </div>
 {{-- <select name="year" class="form-control text-center" id="year" >
        @for($year=2025;$year>2005;$year--)
            <option value="{{en2bn($year)}}">{{en2bn($year)}} </option>
        @endfor
      </select> --}}
       <h4 class="p-3">রোগ নির্বাচন করুন</h4>
      <div class="col-10 d-flex align-items-center justify-content-center">
          <div class="col-5">
      <select name="disease" class="form-control" id="school">
         <option value="" selected> --রোগ নির্বাচন করুন --</option>
            <option value="neat_clean">পরিষ্কার পরিচ্ছন্নতা</option>
            <option value="muac">পুষ্টিগত অবস্থান</option>
            <option value="skin_disease">চর্ম রোগ</option>
            <option value="cough">কাশি</option>
            <option value="asthma">হাঁপানি</option>
            <option value="diarrhoea">ডায়ারিয়া</option>
            <option value="jaundice">জন্ডিস</option>
            <option value="infection">সংক্রমণ</option>
            <option value="epi_tt">ইপিআই টি.টি</option>
            <option value="eye_test">দৃষ্টি পরীক্ষা</option>
            <option value="anemia">রক্তশূন্যতা</option>
            <option value="pulse">পালস ও হার্ট বিটঃ</option>
      
      </select>
          </div></div>
      <div class="col-3 float-right p-2 m-4">
      <button class="btn btn-primary">রিপোর্ট দেখুন</button>
    </div>
    </form>
      </div>
      
     </div>
    </div>
  </section>
  
@stop
