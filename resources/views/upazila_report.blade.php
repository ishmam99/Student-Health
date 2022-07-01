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
                        <div class="col-8 p-5">

                            <table>
                                <tr>
                                    <td style="width:1.5in">{{$name}} </td>
                                    <td>{{ $value }}</td>
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
                                 <tr>
                                    <td style="width:1.5in">পরিষ্কার পরিছন্নতাঃ</td> 
                                 <td>   {{  en2bn($students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->count()) }}/{{ en2bn( $students->where('neat_clean', 0)->count()) }}
                                   </td>

                                </tr>
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
                                height: 400,
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

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Disease', 'Has Marks', {
                                    role: 'style'
                                }],
                                // ['Total Students',{{ $students->count() }},{{ $students->count() }},{{ $students->count() }}],
                                ['Neat Clean', {{ $students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->count() }},
                                    '#b87333'
                                ],
                                ['MUAC', {{ $students->where('muac', '!=', 0)->where('muac', '!=', null)->count() }}, '#ebc334'],
                                ['Skin Disease',
                                    {{ $students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->count() }},
                                    '#b87333'
                                ],
                                ['Cough', {{ $students->where('cough', '!=', 0)->where('cough', '!=', null)->count() }}, '#c6eb34'],
                                ['Asthma', {{ $students->where('asthma', '!=', 0)->where('asthma', '!=', null)->count() }}, '#6beb34'],
                                ['Diarrhoea', {{ $students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->count() }},
                                    '#34eb8f'
                                ],
                                ['Jaundice', {{ $students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->count() }},
                                    '#34e2eb'
                                ],
                            ]);

                            var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                {
                                    calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation"
                                },
                                2
                            ]);

                            var options = {
                                title: "Density of Precious Metals, in g/cm^3",
                                width: 600,
                                height: 400,
                                bar: {
                                    groupWidth: "95%"
                                },
                                legend: {
                                    position: "none"
                                },
                            };
                            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                            chart.draw(view, options);
                        }
                    </script>

                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {
                            packages: ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Disease', 'Zero', {
                                    role: 'style'
                                }],
                                // ['Total Students',{{ $students->count() }},{{ $students->count() }},{{ $students->count() }}],
                                ['Neat Clean', {{ $students->where('neat_clean', 0)->count() }}, '#b87333'],
                                ['MUAC', {{ $students->where('muac', 0)->count() }}, '#ebc334'],
                                ['Skin Disease', {{ $students->where('skin_disease', 0)->count() }}, '#b87333'],
                                ['Cough', {{ $students->where('cough', 0)->count() }}, '#c6eb34'],
                                ['Asthma', {{ $students->where('asthma', 0)->count() }}, '#6beb34'],
                                ['Diarrhoea', {{ $students->where('diarrhoea', 0)->count() }}, '#34eb8f'],
                                ['Jaundice', {{ $students->where('jaundice', 0)->count() }}, '#34e2eb'],

                            ]);
                            var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                {
                                    calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation"
                                },
                                2, {
                                    calc: "stringify",
                                    sourceColumn: 2,
                                    type: "string",
                                    role: "annotation"
                                },
                            ]);

                            var options = {
                                title: "Density of Precious Metals, in g/cm^3",
                                width: 800,
                                height: 500,
                                bar: {
                                    groupWidth: "95%"
                                },
                                legend: {
                                    position: "none"
                                },
                            };
                            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_material"));
                            chart.draw(view, options);
                        }

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
