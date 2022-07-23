@extends('layouts.fixed')
 
@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">উপজেলা ভিত্তিক রিপোর্ট</h1>
                    <input type="button" class="btn btn-success" onclick="printDiv('printableArea')"
                        value="প্রিন্ট বের করুন" />
                </div>


            </div>
        </div>
    </div>
    <div class="content" id="printableArea">
        <div class="container p-5">
            <div class="card p-5">
                <div class="row">
                    <div class="col-2"> <img src="{{ asset('svg/ri_1.png') }}" alt=""
                            style="height: 130px;width:130px"></div>
                    <div class="col-8 text-center" style="height: 210px">
                        <h2><b> জেলা প্রশাসকের কার্যালয়,লক্ষ্মীপুর</b></h2>
                        <h3><b> স্কুল হেলথ কার্ড</b></h3>
                        <h4><b> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</b></h4>
                        <h3>উপজেলা ভিত্তিক শিক্ষার্থীদের ধারাবাহিক স্বাস্থ্য রিপোর্ট</h3>
                    </div>
                    <div class="col-2"> <img src="{{ asset('svg/bgvv.png') }}" alt=""
                            style="height: 120px;width:120px;padding-left:15px">
                        <p>তারিখ : {{ en2bn(Carbon\Carbon::now()->format('d.m.Y')) }}</p>
                    </div>
                    @if ($disease_check == 2)
                     <div class="col-12 row area ">
                          <h4 style="margin-top:150px;margin-bottom:100px ">{{$disease[0]}}</h4>
                      @for ($i = date('Y'); $i > date('Y')-5; $i--)
                          
                    
                        <div class="col-12 p-3 ml-3" style="height: 300px">

                     
                                    <h5 class="font-weight-bold text-center m-5 pt-3">ক্যালেন্ডার বর্ষঃ{{en2bn($i)}}</h5>



                            <div class="justify-content-center pl-5" style="margin-left: 100px" >
                                <table class="table-bordered">
                                  <thead>
                                    <th class="text-center">উপজেলা</th>
                                   <th><th> <th class="text-center">রেটিং জোন</th>
                                    </th></th><th></th><th></th>
                                      <tr>
                                        <th></th>
                                        <th class="text-center" style="width: 15%">১</th>
                                        <th class="text-center" style="width: 15%">২</th>
                                        <th class="text-center" style="width: 15%">৩</th>
                                        <th class="text-center" style="width: 15%">৪</th>
                                        <th class="text-center" style="width: 15%">৫</th>
                                      </tr>
                                    </th>
                                  </thead>
                                   <tbody>
                                     @foreach ($upazilas as $upazila)
                                     <tr>
                                      <td class="text-center">{{$upazila->name}}</td>
                                    
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($disease[1],1)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($disease[1],2)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($disease[1],3)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($disease[1],4)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($disease[1],5)->count())}}</td>
                                     </tr>  
                                   
                                   
                                  @endforeach
                                   </tbody>
                                 
                                </table>
                            </div>





                        </div>
                          @endfor
                    </div>
                    @else
                   
                        @foreach ($disease as $key=>$item)
                             <div class="col-12 row " @if ($key!='neat_clean')
                                 style="margin-top: 320px"
                                 @else
                                 style="margin-top: 20px"
                             @endif  >
                  <div class="col-4">  <h4>{{$item}}</h4></div>
                  <div class="col-8">
                      @for ($i = date('Y'); $i > date('Y')-4; $i--)
                          
                    
                        <div class=" col-12 " style="padding-top:40px" >

                           
                                 <h5 class="font-weight-bold text-center ">ক্যালেন্ডার বর্ষঃ{{en2bn($i)}}</h5>


                          


                            <div class="">
                                <table class="table-bordered">
                                  <thead>
                                    <th class="text-center">উপজেলা</th>
                                   <th><th> <th class="text-center">রেটিং /জন</th>
                                    </th></th><th></th><th></th>
                                      <tr>
                                        <th></th>
                                        <th class="text-center" style="width: 15%">১</th>
                                        <th class="text-center" style="width: 15%">২</th>
                                        <th class="text-center" style="width: 15%">৩</th>
                                        <th class="text-center" style="width: 15%">৪</th>
                                        <th class="text-center" style="width: 15%">৫</th>
                                      </tr>
                                    </th>
                                  </thead>
                                   <tbody>
                                     @foreach ($upazilas as $upazila)
                                     <tr>
                                      <td class="text-center">{{$upazila->name}}</td>
                                    
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($key,1)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($key,2)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($key,3)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($key,4)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where($key,5)->count())}}</td>
                                     </tr>  
                                   
                                   
                                  @endforeach
                                   </tbody>
                                 
                                </table>
                            </div>

                        </div>
                          @endfor
                          </div>
                  </div>
                        @endforeach
                  
                   {{-- <div class="col-12 row" >
                    <h4>পরিষ্কার পরিচ্ছন্নতা</h4>
                      @for ($i = date('Y'); $i > date('Y')-5; $i--)
                          
                    
                        <div class=" col-10 p-3 " style="height: 290px;margin-left:100px">

                           
                                    <h6>{{en2bn($i)}}ঃ</h6>


                          


                            <div class="ml-5">
                                <table class="table-bordered">
                                  <thead>
                                    <th class="text-center">উপজেলা</th>
                                   <th><th> <th class="text-center">রেটিং জোন</th>
                                    </th></th><th></th><th></th>
                                      <tr>
                                        <th></th>
                                        <th class="text-center" style="width: 15%">১</th>
                                        <th class="text-center" style="width: 15%">২</th>
                                        <th class="text-center" style="width: 15%">৩</th>
                                        <th class="text-center" style="width: 15%">৪</th>
                                        <th class="text-center" style="width: 15%">৫</th>
                                      </tr>
                                    </th>
                                  </thead>
                                   <tbody>
                                     @foreach ($upazilas as $upazila)
                                     <tr>
                                      <td class="text-center">{{$upazila->name}}</td>
                                    
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('neat_clean',1)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('neat_clean',2)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('neat_clean',3)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('neat_clean',4)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('neat_clean',5)->count())}}</td>
                                     </tr>  
                                   
                                   
                                  @endforeach
                                   </tbody>
                                 
                                </table>
                            </div>





                        </div>
                          @endfor
                  </div>
                  <div class="col-12 row pt-4" >
                    <h4>পুষ্টিগত অবস্থান</h4>
                      @for ($i = date('Y'); $i > date('Y')-5; $i--)
                          
                    
                        <div class=" col-10 p-3 " style="height: 290px;margin-left:100px">

                           
                                    <h6>{{en2bn($i)}}ঃ</h6>


                          


                            <div class="ml-5">
                                <table class="table-bordered">
                                  <thead>
                                    <th class="text-center">উপজেলা</th>
                                   <th><th> <th class="text-center">রেটিং জোন</th>
                                    </th></th><th></th><th></th>
                                      <tr>
                                        <th></th>
                                        <th class="text-center" style="width: 15%">১</th>
                                        <th class="text-center" style="width: 15%">২</th>
                                        <th class="text-center" style="width: 15%">৩</th>
                                        <th class="text-center" style="width: 15%">৪</th>
                                        <th class="text-center" style="width: 15%">৫</th>
                                      </tr>
                                    </th>
                                  </thead>
                                   <tbody>
                                     @foreach ($upazilas as $upazila)
                                     <tr>
                                      <td class="text-center">{{$upazila->name}}</td>
                                    
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('muac',1)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('muac',2)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('muac',3)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('muac',4)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('muac',5)->count())}}</td>
                                     </tr>  
                                   
                                   
                                  @endforeach
                                   </tbody>
                                 
                                </table>
                            </div>





                        </div>
                          @endfor
                  </div>
                  <div class="col-12 row pt-4" >
                    <h4>চর্ম রোগ</h4>
                      @for ($i = date('Y'); $i > date('Y')-5; $i--)
                          
                    
                        <div class=" col-10 p-3 " style="height: 290px;margin-left:100px">

                           
                                    <h6>{{en2bn($i)}}ঃ</h6>


                          


                            <div class="ml-5">
                                <table class="table-bordered">
                                  <thead>
                                    <th class="text-center">উপজেলা</th>
                                   <th><th> <th class="text-center">রেটিং জোন</th>
                                    </th></th><th></th><th></th>
                                      <tr>
                                        <th></th>
                                        <th class="text-center" style="width: 15%">১</th>
                                        <th class="text-center" style="width: 15%">২</th>
                                        <th class="text-center" style="width: 15%">৩</th>
                                        <th class="text-center" style="width: 15%">৪</th>
                                        <th class="text-center" style="width: 15%">৫</th>
                                      </tr>
                                    </th>
                                  </thead>
                                   <tbody>
                                     @foreach ($upazilas as $upazila)
                                     <tr>
                                      <td class="text-center">{{$upazila->name}}</td>
                                    
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('skin_disease',1)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('skin_disease',2)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('skin_disease',3)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('skin_disease',4)->count())}}</td>
                                       <td class="text-center">{{en2bn(DB::table('student_healths')->where('year',en2bn($i))->where('upazila_name',$upazila->name)->where('skin_disease',5)->count())}}</td>
                                     </tr>  
                                   
                                   
                                  @endforeach
                                   </tbody>
                                 
                                </table>
                            </div>





                        </div>
                          @endfor
                  </div> --}}
                    
                    @endif
                   
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
                        function printDiv(divName) {
                            var printContents = document.getElementById(divName).innerHTML;
                            var originalContents = document.body.innerHTML;

                            document.body.innerHTML = printContents;

                            window.print();

                            document.body.innerHTML = originalContents;
                        }
                    </script>
    </section>
@stop