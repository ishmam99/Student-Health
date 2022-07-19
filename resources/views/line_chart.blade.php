@extends('layouts.fixed')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$name}} ভিত্তিক রিপোর্ট</h1>
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
                    <div class="col-8 text-center">
                        <h2><b> জেলা প্রশাসকের কার্যালয়,লক্ষ্মীপুর</b></h2>
                        <h3><b> স্কুল হেলথ কার্ড</b></h3>
                        <h4><b> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</b></h4>
                        <h3>{{$name}} ভিত্তিক শিক্ষার্থীদের ধারাবাহিক স্বাস্থ্য রিপোর্ট</h3>
                    </div>
                    <div class="col-2"> <img src="{{ asset('svg/bgvv.png') }}" alt=""
                            style="height: 120px;width:120px;padding-left:15px">
                        <p>তারিখ : {{ en2bn(Carbon\Carbon::now()->format('d.m.Y')) }}</p>
                    </div>
                    <div class="col-12 row mt-5">
                        <div class="col-12 p-3">

                            <table class="mb-3">
                                <tr>
                                    <td style="width:1.5in">{{$name}}ঃ </td>
                                    <td>{{ ($value)==null?'সকল উপজেলা
                                    '
                                     : en2bn($value)
                                    }}</td>
                                </tr>
                                 @if ($school ==null && $value !=null)
                                       <td style="width:1.5in"> বিদ্যালয় সংখ্যাঃ </td>
                                    <td>{{ en2bn(App\Models\User::where([['usertype', 1], ['upazila_name', $value]])->count()) }}
                                    </td>
                                    @else
                                    <td style="width:1.5in"> বিদ্যালয়ঃ </td>
                                    <td>{{$school==null ? 'উক্ত জেলা/উপজেলার সকল বিদ্যালয়' :$school}}
                                    </td>
                                  @endif
                                <tr>
                                    <td style="width:1.5in">শিক্ষার্থী সংখ্যাঃ</td>
                                    <td>{{ en2bn($students) }}</td>

                                </tr>
                            </table>
                            <table class="table table-bordered m-5 p-4" >
  <thead>
    <tr>
        <th scope="col">সংখ্যাঃ</th>
      <th scope="col">স্বাস্থ্য বিবরণ</th>
     @foreach ($years['কাশিঃ'] as $key=>$item)
           <th scope="col">গড় মান ({{en2bn($key)}}) </th>
      @endforeach

    </tr>
  </thead>
  <tbody>
  @php
       $count=1;
  @endphp 
     @foreach ($years as $key=>$items)
    <tr>
      
      <th scope="row">{{en2bn($count++)}}</th>
     
      <td >{{$key}}</td> 
       @foreach ($items as $item)
           <td scope="col">{{en2bn(round($item,2))}} </td>
      @endforeach
     

    
    </tr>
     
     @endforeach
   
    
  </tbody>
 
</table>  
 
                          

                        </div>
                    </div>
                  @foreach ($years as $key=>$item)
                  <div class="row">
                       <div class="col-10 mt-2" id="{{$key}}" style="width: 1000px; height: 500px;"></div>
                        <div class="col-10 text-center">
                          
                            @foreach ($item as $keys=>$data)
                                <span >({{en2bn($keys)}} ,{{en2bn(round($data,2))}}),</span>
                            @endforeach
                            
                          </div>
                        </div>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart1);
                        
                        function drawChart1() {
                           var years =@json($item);
                           console.log(years);
                            var chartData = [];
                             Object.keys(years).forEach(function (name) {
                                chartData.push([name, years[name]]);
                              }); 
                            var data = google.visualization.arrayToDataTable(chartData, true);
                            
                            
                            var options = {
                            title: '{{$key}}',
                            curveType: 'function',
                            legend: 'none',
                            pointSize:10
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('{{$key}}'));

                            chart.draw(data, options);
                        }
                        </script>
                       @endforeach

                 
              <script type="text/javascript">
                        function printDiv(divName) {
                            var printContents = document.getElementById(divName).innerHTML;
                            var originalContents = document.body.innerHTML;

                            document.body.innerHTML = printContents;

                            window.print();

                            document.body.innerHTML = originalContents;
                        }
                    </script>
                 
                </div>

            </div>
        </div>
    </div>

    </section>
@stop
