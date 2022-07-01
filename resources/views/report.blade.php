<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
      
        body
        {
            font-family: nikosh;
            font-size: 27px;
        }
        td{
            padding: 3px;
             font-size: 30px;
             font-weight: 50;
        }
    </style>
</head>
<body>
  
       
            <div style="position: absolute;
    top: 0.45in;
    left: 0.12in;
    width: 1.14in;
    height: 1.14in;"> <img src="{{ asset('svg/ri_1.png')}}" alt="" style="height: 180px;width:180px"></div>
            <div style="position: absolute;
    top: 0.20in;
    left: 1.67in;
    text-align:center;
    width: 70%;
    line-height: 0.15in;"><h1 style="font-weight: 900;"><b> জেলা প্রশাসকের কার্যালয়,লক্ষ্মীপুর</b></h1>
    <h2 style="font-weight: 500;"><b> স্কুল হেলথ কার্ড</b></h2>
<h3 style="font-weight: 500;padding-top:25px"><b> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</b></h3>
<h2 style="font-weight: 200;">একক শিক্ষার্থীর ধারাবাহিক স্বাস্থ্য রিপোর্ট</h2></div>
     <div style="    position: absolute;
    top: 0.35in;
    left: 7.65in;
    margin-left:30%;
   
    height: 1.14in;"> <img src="{{ asset('svg/bgvv.png')}}" alt="" style="height: 150px;width:150px;padding-left:15px"><p>তারিখ : {{Carbon\Carbon::now()->format('d.m.Y')}}</p></div>
    <div style="position: absolute;
    top: 1in;">
   <div style="position: absolute;
    top: 3.70in;
    left: 0.12in;
    width: 7.14in;
    height: 1.14in;">

    <table>
        <tr>
            <td style="width:1.5in"> আইডিঃ </td> <td >{{$student->id}} </td>
            
        </tr>
        <tr>
            <td style="width:1.5in">শ্রেণীঃ</td><td >{{$student->classname}} </td>
        </tr>
         <tr>
            <td style="width:1.5in">রোলঃ</td> <td >{{$student->class_roll}} </td>
        </tr>
         <tr>
            <td style="width:1.5in">পিতার নামঃ</td><td >{{$student->father_name}} </td>
        </tr>
         <tr>
            <td style="width:1.5in">জন্ম নিবন্ধনঃ</td><td >{{$student->birth_certificate}} </td>
        </tr>
    </table>
   </div>
   <div style="position: absolute;
    top: 3.70in;
    left: 6.65in;
    width: 7.14in;
    height: 1.14in;">
    <table>
        <tr>
            <td style="width:1.5in">বিদ্যালয়ঃ </td><td >{{$student->school}} </td>
            
        </tr>
        <tr>
            <td style="width:1.5in">শাখাঃ</td> <td >{{$student->section}} </td>
        </tr>
         <tr>
            <td style="width:1.5in">নামঃ</td> <td >{{$student->bangla_name}} </td>
        </tr>
         <tr>
            <td style="width:1.5in">মাতার নামঃ</td><td >{{$student->mother_name}} </td>
        </tr>
        
         <tr>
            <td style="width:1.5in">মোবাইলঃ</td><td >{{$student->mobile}} </td>
        </tr>
    </table>
   </div>
   <div style="position: absolute;
    top: 6.3in;
    
    width: 14in;
    height: 100%;">   
        <table style="border-collapse:collapse;width:100%;">
           
                
            
            <tbody>
                <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">ক্রমিক নং</td>
                    <td style="border:1px solid #000; text-align: center;padding-left: 4px;width:50%">বিবরন</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->year}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">১</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">বয়স</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->age}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">২</td>
                    <td style="border:1px solid #000;padding-left: 4px;width:50%">উচ্চতা(সে.মি.)</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->height}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">৩</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">ওজন(কে.জি.)</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->weight}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">৪</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">পরিষ্কার পরিচ্ছন্নতা</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->neat_clean}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">৫</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">পুষ্টিগত অবস্থান(MUAC)</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->muac}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">৬</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">চর্মরোগ</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->skin_disease}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">৭</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">কাশি</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->cough}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">৮</td>
                    <td style="border:1px solid #000;padding-left: 4px;width:50%">শ্বাস কষ্ট</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->asthma}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">৯</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">ডায়রিয়া</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->diarrhoea}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">১০</td>
                    <td style="border:1px solid #000;ীpadding-left: 4px;width:50%">জণ্ডিস</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->jaundice}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">১১</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">ইনেফকশন (নাক/কান/গলা)</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->infection}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">১২</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">EPI ও TT</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->epi_tt}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">১৩</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">দৃষ্টি পরীক্ষা</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->eye_test}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">১৪</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">রক্তশুণ্যতা</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->anemia}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">১৫</td>
                    <td style="border:1px solid #000; padding-left: 4px;width:50%">পালস ও হার্ট(বিট/মিনিট)</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->pulse}}</td>
                    @endforeach
                      
                    
                </tr>
                 <tr><td style="border:1px solid #000; text-align: center;padding: 4px;width:15%">১৬</td>
                    <td style="border:1px solid #000;padding-left: 4px;width:50%">সামগ্রিক</td>
                 @foreach ($healths as $health)
                        <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$health->overall}}</td>
                    @endforeach
                      
                    
                </tr>

            </tbody>
        </table>
   </div>
    </div>
   
</body>
</html>