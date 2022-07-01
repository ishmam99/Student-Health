@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-2 text-center">  <h1 class="card" style="margin: 11px 19px 10px 16px;
    padding: 8px;"><i class="fas fa-paper-plane"></i></h1></div>
                      <div class="col-10">
                         <h1> শিক্ষার্থীর স্বাস্থ্য তথ্য রিপোর্ট</h1>
                    <p>     একক শিক্ষার্থীর স্বাস্থ্য তথ্য রিপোর্ট</p>
                      </div>
                       
                    </div>
                    
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Package</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="bg-white border-rounded p-3 pt-5">
        <form action="{{route('student.report')}}" method="post">
            @csrf
            <div class="card p-5">
           <div class="row">
            <div class="col-6 mb-5">
                <label for="session">*সেশন</label>
                <select name="session" id="session" class="form-control">
                    @foreach ($sessions as $session)
                        <option value="{{$session}}">{{$session}}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-6 mb-5">
                <label for="upazila">*উপজেলা</label>
                <select name="upazila" id="upazila" class="form-control">
                    @foreach ($upazilas as $upazila)
                         <option value="{{$upazila->name}}">{{$upazila->name}}</option>
                    @endforeach
                   
                </select>
            </div>
            <div class="col-6 mb-5">
                <label for="school">*প্রতিষ্ঠানের নাম</label>
                <select name="school" id="school" class="form-control">
                     @foreach ($schools as $school)
                    <option value="{{$school->id}}">{{$school->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 mb-5">
                <label for="class">*শ্রেণী</label>
                <select name="class" id="class" class="form-control">
                    <option value="১ম">১ম</option>
                    <option value="২য়">২য়</option>
                    <option value="৩য়">৩য়</option>
                    <option value="৪র্থ">৪র্থ</option>
                    <option value="৫ম">৫ম</option>
                    <option value="৬ষ্ঠ">৬ষ্ঠ</option>
                    <option value="৭ম">৭ম</option>
                    <option value="৮ম">৮ম</option>
                    <option value="৯ম">৯ম</option>
                    <option value="১০ম">১০ম</option>
                    
                </select>
            </div><div class="col-6 mb-5">
                <label for="section">*শাখা</label>
                <select name="section" id="section" class="form-control">
                    <option value="ক">ক</option>
                     <option value="খ">খ</option>
                      <option value="গ">গ</option>
                       <option value="ঘ">ঘ</option>
                </select>
            </div>
            <div class="col-6 mb-5">
                <label for="upazila">*ক্লাস রোল</label>
                <input type="text" name="roll" class="form-control">
            </div>
           </div>
           <button type="submit" class="col-2 btn btn-success">সাবমিট</button>
        </div>
        </form>
    </section>
@stop
