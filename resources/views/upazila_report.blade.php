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
      <th scope="col">শিক্ষার্থীর সংখ্যা (মান শূন্যের অধিক) </th>
      <th scope="col">শিক্ষার্থীর সংখ্যা (মান শূন্য)</th>
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">১</th>
      <td >পরিষ্কার পরিছন্নতাঃ</td> 
      <td>{{  en2bn($students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->count()) }}</td>
      <td>{{ en2bn( $students->where('neat_clean', 0)->count()) }}</td>
    
    </tr>
    <tr>
      <th scope="row">২</th>
      <td >মোয়াকঃ</td> 
      <td>{{  en2bn($students->where('muac', '!=', 0)->where('muac', '!=', null)->count()) }}</td>
      <td>{{ en2bn( $students->where('muac', 0)->count()) }}</td>
    </tr>
    <tr>
      <th scope="row">৩</th>
        <td>চর্ম রোগঃ</td> 
        <td>   {{  en2bn($students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('skin_disease', 0)->count()) }}</td>

    </tr>
     <tr>
      <th scope="row">৪</th>
        <td>কাশিঃ</td> 
        <td>   {{  en2bn($students->where('cough', '!=', 0)->where('cough', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('cough', 0)->count()) }}</td>

    </tr>
     <tr>
      <th scope="row">৫</th>
        <td >হাঁপানিঃ</td> 
        <td>   {{  en2bn($students->where('asthma', '!=', 0)->where('asthma', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('asthma', 0)->count()) }}</td>

    </tr>
     <tr>
      <th scope="row">৬</th>
        <td >ডায়ারিয়াঃ</td> 
        <td>   {{  en2bn($students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('diarrhoea', 0)->count()) }}</td>

    </tr>
     <tr>
      <th scope="row">৭</th>
        <td >জন্ডিসঃ</td> 
        <td>   {{  en2bn($students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('jaundice', 0)->count()) }}</td>

    </tr>
     <tr>
      <th scope="row">৮</th>
        <td>সংক্রমণঃ</td> 
        <td>   {{  en2bn($students->where('infection', '!=', 0)->where('infection', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('infection', 0)->count()) }}</td>

    </tr>
     <tr>
      <th scope="row">৯</th>
        <td >ইপিআই টি.টি</td> 
        <td>   {{  en2bn($students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('epi_tt', 0)->count()) }}</td>

    </tr>
     <tr>
      <th scope="row">১০</th>
        <td >চোখ পরীক্ষাঃ</td> 
        <td>   {{  en2bn($students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('eye_test', 0)->count()) }}</td>

    </tr>
    <tr>
      <th scope="row">১১</th>
        <td >রক্তাল্পতাঃ</td> 
        <td>   {{  en2bn($students->where('anemia', '!=', 0)->where('anemia', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('anemia', 0)->count()) }}</td>

    </tr>
    <tr>
      <th scope="row">১২</th>
        <td >পালস</td> 
        <td>   {{  en2bn($students->where('pulse', '!=', 0)->where('pulse', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('pulse', 0)->count()) }}</td>

    </tr>
    <tr>
      <th scope="row">১৩</th>
        <td>সামগ্রিক</td> 
        <td>   {{  en2bn($students->where('overall', '!=', 0)->where('overall', '!=', null)->count()) }}</td>
        <td>{{ en2bn( $students->where('overall', 0)->count()) }}</td>

    </tr>
    
  </tbody>
 
</table>  
 
                          

                        </div>
                    </div>
                    {{-- <div class="col-10 p-5" id="columnchart_material" style="width: 1000px; height: 500px;"></div> --}}
                    <div id="chart_div"></div>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            packages: ['corechart', 'bar']
                        });
                        google.charts.setOnLoadCallback(drawStacked);

                        function drawStacked() {
                            var data = google.visualization.arrayToDataTable([
                                ['Health Issues', 'With Marks', 'Without Marks'],
                                ['Neat Clean', {{ $students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->count() }},{{ $students->where('neat_clean', 0)->count() }}
                                
                                ],
                                ['MUAC', {{ $students->where('muac', '!=', 0)->where('muac', '!=', null)->count() }},{{ $students->where('muac', 0)->count() }} ],
                                ['Skin Disease',
                                    {{ $students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->count() }},  {{ $students->where('skin_disease',  0)->count() }}
                                    
                                ],
                                ['Cough', {{ $students->where('cough', '!=', 0)->where('cough', '!=', null)->count() }},{{ $students->where('cough', 0)->count() }} ],
                                ['Asthma', {{ $students->where('asthma', '!=', 0)->where('asthma', '!=', null)->count() }}, {{ $students->where('asthma', 0)->count() }} ],
                                ['Diarrhoea', {{ $students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->count() }},
                        {{ $students->where('diarrhoea', 0)->count() }}
                                ],
                                ['Jaundice', {{ $students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->count() }},
                                     {{ $students->where('jaundice', 0)->count() }}
                                ],
                                 ['Infection', {{ $students->where('infection', '!=', 0)->where('infection', '!=', null)->count() }},
                                    {{ $students->where('infection',0)->count() }}
                                ],
                                ['EPI TT', {{ $students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->count() }},
                                    {{ $students->where('epi_tt',0)->count() }}
                                ],
                                ['Eye Test', {{ $students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->count() }},
                                    {{ $students->where('eye_test',0)->count() }}
                                ],
                                ['Anemia', {{ $students->where('anemia', '!=', 0)->where('anemia', '!=', null)->count() }},
                                    {{ $students->where('anemia',0)->count() }}
                                ],
                                ['Pulse', {{ $students->where('pulse', '!=', 0)->where('pulse', '!=', null)->count() }},
                                    {{ $students->where('pulse',0)->count() }}
                                ],
                                 ['Overall', {{ $students->where('overall', '!=', 0)->where('overall', '!=', null)->count() }},
                                    {{ $students->where('overall',0)->count() }}
                                ],
                            ]);
                           var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                            { calc: "stringify",
                                              sourceColumn: 1,
                                              type: "string",
                                              role: "annotation" },
                                            2,{ calc: "stringify",
                                              sourceColumn: 2,
                                              type: "string",
                                              role: "annotation" },]);
                            var options = {
                                title: 'শিক্ষার্থীদের ধারাবাহিক স্বাস্থ্য রিপোর্ট',
                                chartArea: {
                                    width: '70%'
                                },
                                 width: 1000,
                                height: 1200,
                                isStacked: true,
                                hAxis: {
                                    title: 'Total Students',
                                    minValue: 0,
                                    maxValue: {{$students->count()}}
                                },
                                vAxis: {
                                    title: 'Health Issues'
                                }
                            };
                            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                            chart.draw(view, options);
                        }

                        google.charts.load("current", {
                            packages: ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                      

                 

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
