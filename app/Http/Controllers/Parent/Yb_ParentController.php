<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\StdApplyLeave;
use App\Models\ParentDetail;
use App\Models\Student;
use App\Models\FeesInvoice;
use App\Models\LeaveType;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Yb_ParentController extends Controller
{
    //
	function yb_index(){
		return view('parent.index');
	}

	function yb_login(Request $request){
        if($request->input()){
			$request->validate([
				'email'=>'required',
				'password'=>'required',
			]); 

			$login = ParentDetail::where(['guardian_email'=>$request->email])->first();

            if(empty($login)){
				return response()->json(['email'=>'Email Does not Exists']);
			}else{
				if(Hash::check($request->password,$login->guardian_password)){
                    $request->session()->put('id',$login->id);
                    $request->session()->put('guardian_name',$login->guardian_name); 
              	    return '1';
				}else{
					return response()->json(['password'=>'Email and Password does not matched']);
				}
			}
		}else{
			return view('parent.parent');
		}
    }

	public function yb_profile(){
        $value = session()->get('id');
        $parentDetail = ParentDetail::with('student_name')->where(['id'=>$value])->first();
		return view('parent.my-child-profile',['parent'=>$parentDetail,'student_name'=>$parentDetail]);
    }

	public function yb_child_profile($id){
		$student = Student::with('class_name','section_name','blood_name','religion_name','parent_name')->where(['id'=>$id])->first();
		return view('parent.child-profile',compact('student'));
    }

	public function yb_child_fees($id){
		$student = Student::where('id',$id)->select('id','first_name','last_name')->first();
		$invoice = FeesInvoice::with('student_details:id,first_name,last_name,class_id,section_id','type_name','group_name')->where('student',$id)->latest('id')->get();
		return view('parent.child-fees',compact('student','invoice'));
    }

	public function yb_child_attendance(Request $request,$student_id){
		if($request->input()){
            $daysInMonth=cal_days_in_month(CAL_GREGORIAN,$request->month,$request->year);
            $studentAtt = StudentAttendance::where('student_id',  $student_id)
			->whereMonth('attendence_date','=',$request->month)
           ->whereYear('attendence_date','=',$request->year)
			->get();
    
            return view('student.attendance-table',['month'=> $request->month,'year'=>$request->year,'daysInMonth' =>$daysInMonth,'studentAtt'=>$studentAtt]);
		}else{
			$student = Student::where('id',$student_id)->select('id','first_name','last_name')->first();
			return view('parent.child-attendance',compact('student'));
		}
		
    }

	public function yb_child_leaves(Request $request,$id){
		if ($request->ajax()) {
			$data = StdApplyLeave::with('leave_title','student_name:id,first_name,last_name')->latest()->where('student_id', $id)->get();
			return Datatables::of($data)
				->addIndexColumn()
				->editColumn('leave_from',function($row){
				return date('d M, Y',strtotime($row->leave_from));
			})
			->editColumn('leave_to',function($row){
				return date('d M, Y',strtotime($row->leave_to));
			})
			->editColumn('apply_date',function($row){
				return date('d M, Y',strtotime($row->apply_date));
			})
			->addColumn('user_name', function($row){
				return $row->student_name->first_name;
			})
			->addColumn('leaveType_title', function($row){
				return $row->leave_title->title;
			})
			->addColumn('approve_status', function($row){
				if($row->approve_status == '0'){
					$approve_status = '<label class="badge bg-light-warning">Pending</label>';
				}elseif($row->approve_status== '1'){
					$approve_status = '<label class="badge bg-light-success">Approve</label>';
				}else{
					$approve_status = '<label class="badge bg-light-danger">Reject</label>';
				}
				return $approve_status;
			})
			->addColumn('action', function($row){
				$btn = '<button data-url="'.url('parent/parent-apply-leaves/').'" data-id="'.$row->id.'" class="view_parentLeave btn btn-primary btn-sm">View</button>';
				return $btn;
			})
			->rawColumns(['approve_status','action'])
			->make(true);
		}
		$student = Student::where('id',$id)->select('id','first_name','last_name')->first();
		$LeaveType = LeaveType::all();
		return view('parent.child-leaves',compact('student','LeaveType'));
    }

	// public function yb_Student_leaves(){ 
        // $value = session()->get('id');
      //   return $value;
       // $data= Student::where(["students.id" => $value])->get();
	//    return $parentDetail = ParentDetail::with('student_name')->where(['id'=>$value])->first();
        // return view('parent.parent-apply-leaves',['data'=> $parentDetail]);
    // }

	public function yb_addStudent_leave(Request $request){
	
		$request->validate([
			 'applyDate'=> 'required',
			 'leave_type' => 'required',
			 'reason' => 'required'
		 ]);
	     $stdApplyLeave = new StdApplyLeave();
		 $stdApplyLeave->student_id = $request->input("std_id");
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
        session()->forget('guardian_name');
        return redirect('parent/login');
    }
}
