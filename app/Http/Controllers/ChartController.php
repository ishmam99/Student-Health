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
        $name = "উপজেলা";
        $value = $request->upazila;
        $students = DB::table('student_healths')->where('upazila_name',$request->upazila)->get();
       return view('upazila_report',compact('students', 'name', 'value'));
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
        $students = DB::table('student_healths')->where('school_id', $request->school)->get();
        return view('upazila_report', compact('students', 'name','value'));
    }
    public function calendarReport(Request $request)
    {
        $name = "ক্যালেন্ডার বর্ষ";
        $value = $request->year;
        $students = DB::table('student_healths')->where('year', $request->year)->get();
        return view('upazila_report', compact('students','name', 'value'));
    }
}
