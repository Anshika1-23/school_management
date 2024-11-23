<?php

namespace App\Http\Controllers\Staff;
use App\Models\Student;
use App\Models\AssignClassTeacher;
use App\Models\StdClass;
use App\Models\Section;
use App\Models\StudentAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Yb_StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $value = session()->get('id');
        $assignedClasses = AssignClassTeacher::with('class_name:id,title')->select(['class_id',DB::raw("GROUP_CONCAT(section_id SEPARATOR ',') as sections")])->where('staff_id', $value)->groupBy('class_id')->get();
        return view('staff.student-attendance.index',['class'=>$assignedClasses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $student = Student::with('class_name','section_name')->where(['class_id'=>$request->class_id,'section_id'=>$request->section_id])->latest()->get();
        $studentAttendance = StudentAttendance::select('student_id')->where(['class_id'=>$request->input('class_id'),'section_id'=>$request->input('section_id'),'attendence_date'=>$request->input('date')])->pluck('student_id')->toArray();
        return view('staff.student-attendance.view-attendance',['date'=>$request->date,'role'=> $student,'attendance'=>$studentAttendance]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       // return $request->input();
        for($i = 0;$i <count($request->student_id); $i++){
            $studentAttendance =  StudentAttendance::updateOrCreate(['student_id'=>$request->student_id[$i],'attendence_date'=>$request->date[$i] ]);
            if(date('l',strtotime($request->date[$i])) != 'Sunday'){
                $studentAttendance->attendence_type = $request->attendance[$request->student_id[$i]];
            }
            $studentAttendance->description = $request->description[$i];
            $studentAttendance->class_id = $request->class_id[$i];
            $studentAttendance->section_id = $request->section_id[$i];
            $studentAttendance->student_id = $request->student_id[$i];
            $studentAttendance->save();
        }
        return '1';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function std_AttendanceReport(Request $request){
        if($request->input()){
           // return $request->input();
            $std = Student::with('class_name','section_name')->where(['class_id'=>$request->class_id,'section_id'=>$request->section_id])->latest()->get();
           // $std = Student::with('class_name','section_name')->where('class_id'=>$request->class_id,'section_id'=>$request->section_id)->latest()->get();
            $month= (explode("-",$request->input('month')));
            $daysInMonth=cal_days_in_month(CAL_GREGORIAN,$month[1],$month[0]);
            // Retrieve the IDs of all student members
            $stdIds = $std->pluck('id')->toArray();
           // Use the staff IDs to filter attendance records
           $studentAtt = StudentAttendance::whereIn('student_id',  $stdIds)->get();

          return view('staff.student-attendance.show-attendance-report',['month'=> $month,'std'=>$std,'daysInMonth' =>$daysInMonth,'studentAtt'=>$studentAtt]);
        }else{
            $value = session()->get('id');
            $assignedClasses = AssignClassTeacher::with('class_name:id,title')->select(['class_id',DB::raw("GROUP_CONCAT(section_id SEPARATOR ',') as sections")])->where('staff_id', $value)->groupBy('class_id')->get();
            return view('staff.student-attendance.attendance-report',['class'=>$assignedClasses]);
        }
      
    }
}
