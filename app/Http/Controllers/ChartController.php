<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
       
        $pdf = \PDF::loadView('chart');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 1000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->stream();
    }
    public function student()
    {
        $upazilas = DB::table('upazilas')->get();
        $schools = DB::table('users')->where('usertype', 1)->get();
        $sessions = ['২০০০', '২০০১', '২০০২', '২০০৩', '২০০৪', '২০০৫', '২০০৬', '২০০৭', '২০০৮', '২০০৯', '২০১০', '২০১১', '২০১২', '২০১৩', '২০১৪', '২০১৫', '২০১৬', '২০১৭', '২০১৮', '২০১৯', '২০২০', '২০২১', '২০২২', '২০২৩', '২০২৪', '২০২৫', '২০২৬', '২০২৭', '২০২৮', '২০২৯', '২০৩০'];

        return view('search', compact('upazilas', 'schools', 'sessions'));
    }
    public function report(Request $request)
    {
      
        $student = DB::table('students')
        ->join('users', 'students.school_id', 'users.id')
        ->select('students.*', 'users.name as school',)
        ->where([['session', $request->session], ['students.upazila_name', $request->upazila], ['section', $request->section], ['school_id', $request->school], ['classname', $request->class], ['class_roll', $request->roll]])
            ->first();
      
        $healths = DB::table('student_healths')->where('auto_id', $student->id)->get();

        $pdf = \PDF::loadView('report', compact('healths', 'student'));
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 1000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->download('a.pdf');
    }
    public function upazilaShow()
    {
        $upazilas = DB::table('upazilas')->get();
       
        
        return view('upazila',compact('upazilas'));
    }
    public function calendarShow()
    {
        $upazilas = DB::table('upazilas')->get();
        return view('calendar', compact('upazilas'));
    }
    public function schoolShow()
    {
        $schools = DB::table('users')->where('usertype',1)->get();
        return view('school', compact('schools'));
    }
    public function ageShow()
    {
       
        return view('age');
    }
    public function upazilaReport(Request $request)
    {
        $check = [];
        $years = [];
        if($request->disease==null){
             for($i=bn2en($request->year_from);$i<=bn2en($request->year_to);$i++)
       {
        $year =DB::table('student_healths')->where('year', en2bn($i))->get();
        $years[]=$year;
       }
        }
        else
        {
            
            for ($i = bn2en($request->year_from); $i <= bn2en($request->year_to); $i++) {
                $year = DB::table('student_healths')->where('year', en2bn($i))->where($request->disease, '>', 0)->get($request->disease);
                $count = $year->where($request->disease,'>',0)->count();
              
                $sum = $year->where($request->disease,'>',0)->sum($request->disease);
                $check[]=$sum;
                $check[]=$count;
                $avg = $sum/$count;
                $check[] = $avg;
                // $year = $year->where($request->disease,'>',0)->get($request->disease);
                $years[] = $year;
            }
        }
      
       dd($check,$years);
        $name = "উপজেলা";
        $value = $request->upazila;
        $students = DB::table('student_healths')->where('upazila_name',$request->upazila)->get();
        $student = $this->destructure($students);
       return view('upazila_report',compact('students', 'name', 'value','student'));
    }
    public function ageReport(Request $request)
    {
        $name = "বয়স";
     
        $value = $request->age;
        $students = DB::table('student_healths')->whereOr('age', $request->age)->whereOr('age', bn2en($request->age))->get();
        return view('upazila_report', compact('students','name', 'value'));
    }
    public function schoolReport(Request $request)
    {
        
        $name = "শিক্ষা প্রতিষ্ঠান";
        $school = User::findOrfail($request->school);
        $value = $school->name;
        $student = DB::table('student_healths')->where('school_id', $request->school)->get();
        $students = $this->destructure($student);
        return view('upazila_report', compact('students', 'name','value'));
    }
    public function calendarReport(Request $request)
    {
        $name = "ক্যালেন্ডার বর্ষ";
        $value = $request->year;
        $students = DB::table('student_healths')->where('year', $request->year)->get();
        return view('upazila_report', compact('students','name', 'value'));
    }
    public function destructure($students)
    {
        $neat_clean =[];
        $muac =[];
        $skin_disease =[];
        $cough =[];
        $asthma = [];
        $diarrhoea =[];
        $jaundice =[];
        $infection = [];
        $epi_tt =[];
        $eye_test =[];
        $anemia =[];
        $pulse =[];
        $overall =[];
        $years = [];
       for($year = now()->format('Y')-4;$year<=now()->format('Y');$year++)
       {
        $neat_clean[] =  $students->where('neat_clean', '!=', 0)->where('neat_clean', '!=', null)->where('year',en2bn($year))->count();
        $muac[] =  $students->where('muac', '!=', 0)->where('muac', '!=', null)->where('year',en2bn($year))->count();
        $skin_disease[] =  $students->where('skin_disease', '!=', 0)->where('skin_disease', '!=', null)->where('year',en2bn($year))->count();
        $cough[] =  $students->where('cough', '!=', 0)->where('cough', '!=', null)->where('year',en2bn($year))->count();
        $asthma[] =  $students->where('asthma', '!=', 0)->where('asthma', '!=', null)->where('year',en2bn($year))->count();
        $diarrhoea[] =  $students->where('diarrhoea', '!=', 0)->where('diarrhoea', '!=', null)->where('year',en2bn($year))->count();
        $jaundice[] =  $students->where('jaundice', '!=', 0)->where('jaundice', '!=', null)->where('year',en2bn($year))->count();
        $infection[] =  $students->where('infection', '!=', 0)->where('infection', '!=', null)->where('year',en2bn($year))->count();
        $epi_tt[] =  $students->where('epi_tt', '!=', 0)->where('epi_tt', '!=', null)->where('year',en2bn($year))->count();
        $eye_test[] =  $students->where('eye_test', '!=', 0)->where('eye_test', '!=', null)->where('year',en2bn($year))->count();
        $anemia[] =  $students->where('anemia', '!=', 0)->where('anemia', '!=', null)->where('year',en2bn($year))->count();
        $pulse[] =  $students->where('pulse', '!=', 0)->where('pulse', '!=', null)->where('year',en2bn($year))->count();
        $overall[] =  $students->where('overall', '!=', 0)->where('overall', '!=', null)->where('year',en2bn($year))->count();
        $years[] = $year;
       }
       $all=[$years,$neat_clean,$muac,$skin_disease,$cough,$asthma,$diarrhoea,$jaundice,$infection,$epi_tt,$eye_test,$anemia,$pulse,$overall];
      
       return $all;
    }
    public function schoolList($id)
    {
       $schools = DB::table('users')->where('upazila_name',$id)->get();

        return json_encode($schools);
    }
}
