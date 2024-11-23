<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\FeesInvoice;
use App\Models\HomeWork;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\StdApplyLeave;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Yb_StudentController extends Controller
{
    //
    function yb_login(Request $request){
        if($request->input()){

			$request->validate([
				'email'=>'required',
				'password'=>'required',
			]); 

			$login = Student::where(['email'=>$request->email])->first();

            if(empty($login)){
				return response()->json(['email'=>'Email Does not Exists']);
			}else{
				if(Hash::check($request->password,$login->password)){
                    $request->session()->put('id',$login->id);
                    $request->session()->put('first_name',$login->first_name); 
              	    return '1';
				}else{
					return response()->json(['password'=>'Email and Password does not matched']);
				}
			}
		}else{
			return view('student.student');
		}
    }

    public function yb_profile(){
        $value = session()->get('id');
       // $data = AssignClassTeacher::with('class_name','section_name')->where(["staff_id" => $value])->latest()->get();
        $student = Student::with('class_name','section_name','blood_name','religion_name','parent_name')->where(['id'=>$value])->first();
        return view('student.index',['student'=>$student]);
    }

    public function yb_my_leaves(){ 
        $value = session()->get('id');
      //   return $value;
        $data= Student::where(["students.id" => $value])->get();
        return view('student.student-leave',['data'=> $data]);
    }

    public function yb_add_leave(Request $request){
       // return $request->input();
           $request->validate([
            'applyDate'=> 'required',
            'leave_type' => 'required',
            'reason' => 'required'
        ]);
        $value = $request->session()->get('id');
        $stdApplyLeave = new StdApplyLeave();
        $stdApplyLeave->student_id = $value;
        $stdApplyLeave->apply_date  = $request->input("applyDate");
        $stdApplyLeave->leave_from  = $request->input("from_date");
        $stdApplyLeave->leave_to = $request->input("to_date");
        $stdApplyLeave->type_id = $request->input("leave_type");
        $stdApplyLeave->reason  = $request->input("reason");
        $result = $stdApplyLeave->save();
        return $result;
    }

    public function yb_logout(Request $req) {
        Auth::logout();
        session()->forget('id');
        session()->forget('first_name');
        return redirect('student/login');
    }

    public function yb_fees_detail(Request $request){
        $id = session()->get('id');
        if($request->ajax()){
           $data = FeesInvoice::with('student_details:id,first_name,last_name,class_id,section_id','type_name','group_name')->where('student',$id)->latest('id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('student_full_name', function($row){
                    return $row->student_details->full_name;
                })
                ->addColumn('class_section', function($row){
                    return $row->student_details->class_name->title.' ('.$row->student_details->section_name->title.')';
                })
                ->addColumn('fees_type', function($row){
                    return $row->type_name->title.' ('.$row->group_name->title.')';
                })
                ->addColumn('fees_status', function($row){
                    if($row->status != '0'){
                        return '<span class="badge bg-success">Paid</label>';
                    }else{
                        return '<span class="badge bg-danger">Not Paid</label>';
                    }
                })
                ->rawColumns(['fees_status'])
                ->make(true);
        }
        return view('student.fees');
    }


    public function yb_homework_detail(Request $request){
        $id = session()->get('id');
        $student = Student::select('class_id','section_id')->find($id);
        if($request->ajax()){
            $data = HomeWork::with('subject_name:id,title')->where(['class_id'=>$student->class_id,'section_id'=>$student->section_id])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('subject', function($row){
                    return $row->subject_name->title;
                })
                ->editColumn('homework_date', function($row){
                    return date('d M, Y',strtotime($row->homework_date));
                })
                ->editColumn('submission_date', function($row){
                    return date('d M, Y',strtotime($row->submission_date));
                })
                ->addColumn('action', function($row){
                    return '<a href="homework/'.$row->id.'/view" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('student.homework');
    }

    public function yb_view_homework_detail($id){
        $homework = HomeWork::with('subject_name:id,title')->where(['id'=>$id])->first();
        return view('student.view-homework',compact('homework'));
    }

    public function yb_attendance(Request $request){
        if($request->input()){
            // return $request->input();
            $student_id = session()->get('id');
            $daysInMonth=cal_days_in_month(CAL_GREGORIAN,$request->month,$request->year);
           $studentAtt = StudentAttendance::where('student_id',$student_id)
           ->whereMonth('attendence_date','=',$request->month)
           ->whereYear('attendence_date','=',$request->year)
           ->get();
    
            return view('student.attendance-table',['month'=> $request->month,'year'=>$request->year,'daysInMonth' =>$daysInMonth,'studentAtt'=>$studentAtt]);
            
        }else{
            return view('student.attendance');
        }
    }

}
