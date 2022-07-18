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
                                    <td>{{ en2bn($value) }}</td>
                                </tr>
                                {{-- <tr>
                                    <td style="width:1.5in"> বিদ্যালয় সংখ্যাঃ </td>
                                    <td>{{ en2bn(App\Models\User::where([['usertype', 1], ['upazila_name', $upazila]])->count()) }}
                                    </td>

                                </tr> --}}
                                <tr>
                                    <td style="width:1.5in">শিক্ষার্থী সংখ্যাঃ</td>
                                    <td>{{ en2bn($students->count()) }}</td>

                                </tr>
                            </table>
                            <table class="table table-bordered m-5 p-4" >
  <thead>
    <tr>
        <th scope="col">সংখ্যাঃ</th>
      <th scope="col">স্বাস্থ্য বিবরণ</th>
      @foreach ($student[0] as $item)
           <th scope="col">শিক্ষার্থীর সংখ্যা ({{en2bn($item)}}) </th>
      @endforeach
{{--      
      <th scope="col">শিক্ষার্থীর সংখ্যা (২০১৯)</th>
      <th scope="col">শিক্ষার্থীর সংখ্যা (২০২০)</th>
      <th scope="col">শিক্ষার্থীর সংখ্যা (২০২১)</th>
      <th scope="col">শিক্ষার্থীর সংখ্যা (২০২২)</th>
      <th scope="col">শিক্ষার্থীর সংখ্যা (২০২৩)</th>
      --}}
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">১</th>
      <td >পরিষ্কার পরিছন্নতাঃ</td> 
       @foreach ($student[1] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
      {{-- <td>{{  en2bn($students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->where('year','২০১৮')->count()) }}</td>
      <td>{{ en2bn($students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->where('year','২০১৯')->count()) }}</td>
      <td>{{ en2bn($students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->where('year','২০২০')->count()) }}</td>
      <td>{{ en2bn($students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->where('year','২০২১')->count()) }}</td>
      <td>{{ en2bn($students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->where('year','২০২২')->count()) }}</td>
      <td>{{ en2bn($students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}

    
    </tr>
    <tr>
      <th scope="row">২</th>
      <td >মোয়াকঃ</td> 
      @foreach ($student[2] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
      {{-- <td>{{ en2bn($students->where('muac', '!=', 0)->where('muac', '!=', null)->where('year','২০১৮')->count()) }}</td>
      <td>{{ en2bn($students->where('muac', '!=', 0)->where('muac', '!=', null)->where('year','২০১৯')->count()) }}</td>
      <td>{{ en2bn($students->where('muac', '!=', 0)->where('muac', '!=', null)->where('year','২০২০')->count()) }}</td>
      <td>{{ en2bn($students->where('muac', '!=', 0)->where('muac', '!=', null)->where('year','২০২১')->count()) }}</td>
      <td>{{ en2bn($students->where('muac', '!=', 0)->where('muac', '!=', null)->where('year','২০২২')->count()) }}</td>
      <td>{{ en2bn($students->where('muac', '!=', 0)->where('muac', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}

    </tr>
    <tr>
      <th scope="row">৩</th>
        <td>চর্ম রোগঃ</td> 
        @foreach ($student[3] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}
       


    </tr>
     <tr>
      <th scope="row">৪</th>
        <td>কাশিঃ</td> 
        @foreach ($student[4] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('cough', '!=', 0)->where('cough', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('cough', '!=', 0)->where('cough', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('cough', '!=', 0)->where('cough', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('cough', '!=', 0)->where('cough', '!=', null)->where('year','২০২১')->count()) }}</td>
       
        <td>{{ en2bn($students->where('cough', '!=', 0)->where('cough', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('cough', '!=', 0)->where('cough', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}
       


    </tr>
     <tr>
      <th scope="row">৫</th>
        <td >হাঁপানিঃ</td> 
        @foreach ($student[5] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('asthma', '!=', 0)->where('asthma', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('asthma', '!=', 0)->where('asthma', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('asthma', '!=', 0)->where('asthma', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('asthma', '!=', 0)->where('asthma', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('asthma', '!=', 0)->where('asthma', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('asthma', '!=', 0)->where('asthma', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}

    </tr>
     <tr>
      <th scope="row">৬</th>
        <td >ডায়ারিয়াঃ</td> 
        @foreach ($student[6] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}

    </tr>
     <tr>
      <th scope="row">৭</th>
        <td >জন্ডিসঃ</td> 
       @foreach ($student[7] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}

    </tr>
     <tr>
      <th scope="row">৮</th>
        <td>সংক্রমণঃ</td> 
     @foreach ($student[8] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('infection', '!=', 0)->where('infection', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('infection', '!=', 0)->where('infection', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('infection', '!=', 0)->where('infection', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('infection', '!=', 0)->where('infection', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('infection', '!=', 0)->where('infection', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('infection', '!=', 0)->where('infection', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}


    </tr>
     <tr>
      <th scope="row">৯</th>
        <td >ইপিআই টি.টি</td> 
       @foreach ($student[9] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}


    </tr>
     <tr>
      <th scope="row">১০</th>
        <td >চোখ পরীক্ষাঃ</td> 
       @foreach ($student[10] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}


    </tr>
    <tr>
      <th scope="row">১১</th>
        <td >রক্তাল্পতাঃ</td> 
    @foreach ($student[11] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('anemia', '!=', 0)->where('anemia', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('anemia', '!=', 0)->where('anemia', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('anemia', '!=', 0)->where('anemia', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('anemia', '!=', 0)->where('anemia', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('anemia', '!=', 0)->where('anemia', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('anemia', '!=', 0)->where('anemia', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}


    </tr>
    <tr>
      <th scope="row">১২</th>
        <td >পালস</td> 
       @foreach ($student[12] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('pulse', '!=', 0)->where('pulse', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('pulse', '!=', 0)->where('pulse', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('pulse', '!=', 0)->where('pulse', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('pulse', '!=', 0)->where('pulse', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('pulse', '!=', 0)->where('pulse', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('pulse', '!=', 0)->where('pulse', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}


    </tr>
    <tr>
      <th scope="row">১৩</th>
        <td>সামগ্রিক</td> 
        @foreach ($student[13] as $item)
           <td scope="col">{{en2bn($item)}} </td>
      @endforeach
        {{-- <td>{{ en2bn($students->where('overall', '!=', 0)->where('overall', '!=', null)->where('year','২০১৮')->count()) }}</td>
        <td>{{ en2bn($students->where('overall', '!=', 0)->where('overall', '!=', null)->where('year','২০১৯')->count()) }}</td>
        <td>{{ en2bn($students->where('overall', '!=', 0)->where('overall', '!=', null)->where('year','২০২০')->count()) }}</td>
        <td>{{ en2bn($students->where('overall', '!=', 0)->where('overall', '!=', null)->where('year','২০২১')->count()) }}</td>
        <td>{{ en2bn($students->where('overall', '!=', 0)->where('overall', '!=', null)->where('year','২০২২')->count()) }}</td>
        <td>{{ en2bn($students->where('overall', '!=', 0)->where('overall', '!=', null)->where('year','২০২৩')->count()) }}</td> --}}


    </tr>
    
  </tbody>
 
</table>  
 
                          

                        </div>
                    </div>
                    <div class="col-12 p-5" id="chart_div" style="width: 1000px; height: 500px;"></div>
                    <div class="col-12 p-5" id="curve_chart" style="width: 1000px; height: 500px;"></div>
                    {{-- <div id="chart_div"></div> --}}
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart1);

                        function drawChart1() {
                            var data = google.visualization.arrayToDataTable([
                            ['Year', 'Average'],
                            ['2004',  1],
                            ['2005',  3],
                            ['2006',  5],
                            ['2007',  2]
                            ]);
                            //   var view = new google.visualization.DataView(data);
                            //             view.setColumns([0, 1, {
                            //                 calc: 'stringify',
                            //                 sourceColumn: 1,
                            //                 type: 'string',
                            //                 role: 'annotation'
                            //             }]);
                            var options = {
                            title: 'পরিষ্কার পরিছন্নতাঃ',
                            curveType: 'function',
                            legend: 'none',
                            pointSize:10
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                            chart.draw(data, options);
                        }
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                         function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Health Issues', '{{en2bn($student[0][0])}}', '{{en2bn($student[0][1])}}','{{en2bn($student[0][2])}}','{{en2bn($student[0][3])}}','{{en2bn($student[0][4])}}'],
                                ['Neat Clean', {{$student[1][0]}}, {{$student[1][1]}},{{$student[1][2]}},{{$student[1][3]}},{{$student[1][4]}}
                                ],
                                ['MUAC', {{$student[2][0]}}, {{$student[2][1]}},{{$student[2][2]}},{{$student[2][3]}},{{$student[2][4]}}
                                ],
                                ['Skin Disease', {{$student[3][0]}}, {{$student[3][1]}},{{$student[3][2]}},{{$student[3][3]}},{{$student[3][4]}}
                                ],
                                ['Cough', {{$student[4][0]}}, {{$student[4][1]}},{{$student[4][2]}},{{$student[4][3]}},{{$student[4][4]}}
                                ],
                                 ['Asthma',{{$student[5][0]}}, {{$student[5][1]}},{{$student[5][2]}},{{$student[5][3]}},{{$student[5][4]}}
                                ],
                                 ['Diarrhoea', {{$student[6][0]}}, {{$student[6][1]}},{{$student[6][2]}},{{$student[6][3]}},{{$student[6][4]}}
                                ],
                                  ['Jaundice',{{$student[7][0]}}, {{$student[7][1]}},{{$student[7][2]}},{{$student[7][3]}},{{$student[7][4]}}
                                ],
                                 ['Infection', {{$student[8][0]}}, {{$student[8][1]}},{{$student[8][2]}},{{$student[8][3]}},{{$student[8][4]}}
                                ],
                                ['EPI TT ',{{$student[9][0]}}, {{$student[9][1]}},{{$student[9][2]}},{{$student[9][3]}},{{$student[9][4]}}
                                ],
                                ['Eye Test', {{$student[10][0]}}, {{$student[10][1]}},{{$student[10][2]}},{{$student[10][3]}},{{$student[10][4]}}
        
                                ],
                                 ['Anemia',{{$student[11][0]}}, {{$student[11][1]}},{{$student[11][2]}},{{$student[11][3]}},{{$student[11][4]}}
                                ],
                                 ['Pulse', {{$student[12][0]}}, {{$student[12][1]}},{{$student[12][2]}},{{$student[12][3]}},{{$student[12][4]}}
                                ],
                                 ['Overall', {{$student[13][0]}}, {{$student[13][1]}},{{$student[13][2]}},{{$student[13][3]}},{{$student[13][4]}}
        
                                ],
                        //         ['MUAC', {{ $students->where('muac', '!=', 0)->where('muac', '!=', null)->count() }},{{ $students->where('muac', 0)->count() }} ],
                        //         ['Skin Disease',
                        //             {{ $students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->count() }},  {{ $students->where('skin_disease',  0)->count() }}
                                    
                        //         ],
                        //         ['Cough', {{ $students->where('cough', '!=', 0)->where('cough', '!=', null)->count() }},{{ $students->where('cough', 0)->count() }} ],
                        //         ['Asthma', {{ $students->where('asthma', '!=', 0)->where('asthma', '!=', null)->count() }}, {{ $students->where('asthma', 0)->count() }} ],
                        //         ['Diarrhoea', {{ $students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->count() }},
                        // {{ $students->where('diarrhoea', 0)->count() }}
                        //         ],
                        //         ['Jaundice', {{ $students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->count() }},
                        //              {{ $students->where('jaundice', 0)->count() }}
                        //         ],
                        //          ['Infection', {{ $students->where('infection', '!=', 0)->where('infection', '!=', null)->count() }},
                        //             {{ $students->where('infection',0)->count() }}
                        //         ],
                        //         ['EPI TT', {{ $students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->count() }},
                        //             {{ $students->where('epi_tt',0)->count() }}
                        //         ],
                        //         ['Eye Test', {{ $students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->count() }},
                        //             {{ $students->where('eye_test',0)->count() }}
                        //         ],
                        //         ['Anemia', {{ $students->where('anemia', '!=', 0)->where('anemia', '!=', null)->count() }},
                        //             {{ $students->where('anemia',0)->count() }}
                        //         ],
                        //         ['Pulse', {{ $students->where('pulse', '!=', 0)->where('pulse', '!=', null)->count() }},
                        //             {{ $students->where('pulse',0)->count() }}
                        //         ],
                        //          ['Overall', {{ $students->where('overall', '!=', 0)->where('overall', '!=', null)->count() }},
                        //             {{ $students->where('overall',0)->count() }}
                        //         ],
                            ]);
                           var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                            { calc: "stringify",
                                                sourceColumn: 1,
                                                type: "string",
                                                role: "annotation" },
                                            2]);
                            var options = {
                                title: 'শিক্ষার্থীদের ধারাবাহিক স্বাস্থ্য রিপোর্ট',
                                chartArea: {
                                    width: '100%'
                                },
                                //  width: 1000,
                                // height: 400,
                                // // isStacked: true,
                                // hAxis: {
                                //     title: 'Total Students',
                                //     minValue: 0,
                                   
                                // },
                               
                            };
                             var chart = new google.charts.Bar(document.getElementById('chart_div'));

                            chart.draw(data, google.charts.Bar.convertOptions(options))
                            // var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                            // chart.draw(view, options);
                        }

                        // google.charts.load("current", {
                        //     packages: ['corechart']
                        // });
                        // google.charts.setOnLoadCallback(drawChart);

                      

                 

                        function printDiv(divName) {
                            var printContents = document.getElementById(divName).innerHTML;
                            var originalContents = document.body.innerHTML;

                            document.body.innerHTML = printContents;

                            window.print();

                            document.body.innerHTML = originalContents;
                        }
                    </script>
                    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Students', 'percentage'],
  ['Neat Clean', {{($students->where('neat_clean','!=',0)->count()/$students->count())*100}}],
  ['MUAC', {{($students->where('muac','!=',null)->count()/$students->count())*100}}],
  ['Skin Disease', {{($students->where('skin_disease','!=',0)->count()/$students->count())*100}}],
  ['Cough', {{($students->where('cough','!=',0)->count()/$students->count())*100}}],
  ['Asthma', {{($students->where('asthma','!=',0)->count()/$students->count())*100}}]
]);

  // Optional; add a title and set the width and height of the chart
  var options = { 'width':750, 'height':500};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script> --}}
                </div>

            </div>
        </div>
    </div>

    </section>
@stop
