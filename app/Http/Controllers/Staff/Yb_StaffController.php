<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\AcademicYear;
use App\Models\StdClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\Staff;
use App\Models\LeaveType;
use App\Models\Notice;
use App\Models\ApplyLeave;
use App\Models\AssignClassTeacher;
use App\Models\AssignSubjectTeacher;
use App\Models\StdApplyLeave;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_StaffController extends Controller
{
    //
    function yb_login(Request $request){
        if($request->input()){
			$request->validate([
				'email'=>'required',
				'password'=>'required',
			]); 

			$login = Staff::where(['email'=>$request->email])->first();
            if(empty($login)){
              	return response()->json(['email'=>'Email Does not Exists']);
			}else{
                if(Hash::check($request->password,$login->password)){
                    $request->session()->put('id',$login->id);
                    $request->session()->put('f_name',$login->f_name); 
              	    return '1';
				}else{
					return response()->json(['password'=>'Email and Password does not matched']);
				}
			}
		}else{
			return view('staff.staff');
		}
    }

    public function yb_dashboard(){
        $id = session()->get('id');
        $classes = AssignClassTeacher::where('staff_id',$id)->count();
        $subjects = AssignSubjectTeacher::where('staff_id',$id)->count();
        $notice = Notice::where('message_to','2')->get();
        $student_leaves = StdApplyLeave::with('leave_title:id,title','student_name:id,first_name,last_name')->where('approve_status','0')->get();
        return view('staff.index',compact('notice','student_leaves','classes','subjects'));
    }

    public function yb_profile(){
        $value = session()->get('id');
        $staff = Staff::with('role_name:id,title','department_name:id,title','designation_name:id,title')->where(['id'=>$value])->first();
        return view('staff.my-profile',['teacher'=>$staff]);
    }

    public function yb_my_leaves(){ 
        $value = session()->get('id');
        // return $value;
        $data= Staff::where(["staffs.id" => $value])->get();
        return view('staff.staff-leave',['data'=> $data]);
         
    }

    public function yb_add_leave(Request $request){
       // return $request->input();
           $request->validate([
            'applyDate'=> 'required',
            'leave_type' => 'required',
            'reason' => 'required'
        ]);
        $value = $request->session()->get('id');
        $applyLeave = new ApplyLeave();
        $applyLeave->staff_id = $value;
        $applyLeave->apply_date  = $request->input("applyDate");
        $applyLeave->leave_from  = $request->input("from_date");
        $applyLeave->leave_to = $request->input("to_date");
        $applyLeave->type_id = $request->input("leave_type");
        $applyLeave->reason  = $request->input("reason");
        $result = $applyLeave->save();
        return $result;
    }

    public function yb_assignClass(Request $request){
      $value = session()->get('id');
      $data = AssignClassTeacher::with('class_name','section_name')->where(["staff_id" => $value])->latest()->get();
        if ($request->ajax()) {
            $data = AssignClassTeacher::with('class_name','section_name')->where(["staff_id" => $value])->latest()->get();
                    return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('class', function($row){
                        return $row->class_name->title;
                    })
                    ->addColumn('section', function($row){
                        return $row->section_name->title;
                    })
                    ->make(true);
        }
        return view('staff.assign-class');
    }

    public function yb_assignedSubjects(Request $request){
      $value = session()->get('id');
      
        if ($request->ajax()) {
            $data = AssignSubjectTeacher::with('class_name','section_name','subject_name')->where(["staff_id" => $value])->latest()->get();
                    return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('subject', function($row){
                        return $row->subject_name->title;
                    })
                    ->addColumn('class', function($row){
                        return $row->class_name->title;
                    })
                    ->addColumn('section', function($row){
                        return $row->section_name->title;
                    })
                    ->make(true);
        }
        return view('staff.assign-subject');
    }

    public function yb_student_list(Request $request){
        //return $request->input();
        $value = session()->get('id');
       
        $assignedClasses = AssignClassTeacher::with('class_name')->select(['class_id',DB::raw("GROUP_CONCAT(section_id SEPARATOR ',') as sections")])->where('staff_id', $value)->groupBy('class_id')->get();
               
        $academicYear = AcademicYear::all();
        $stdClass = StdClass::all();
        $section = Section::all();

        $where = '';
        if($request->class_id){
            if($where != ''){ $where .= ' AND '; }
            $where .= 'class_id= "'.$request->class_id.'"';
        }
       
        if($request->section_id){
            if($where != ''){ $where .= ' AND '; }
            $where .= 'section_id= "'.$request->section_id.'"';
        }
        if($request->std_name){
            if($where != ''){ $where .= ' AND '; }
            $where .= 'first_name= "'.$request->std_name.'"';
        }
        if($request->roll_no){
            if($where != ''){ $where .= ' AND '; }
            $where .= 'roll_no= "'.$request->roll_no.'"';
        }
           
    //   return   $student = Student::with('class_name:id,title','section_name:id,title','parent_name','category_name:id,title')
    //     ->orderBy('students.class_id','desc')
    //     ->get();
        if($where != ''){
           $students = Student::with('class_name:id,title','section_name:id,title','parent_name','category_name:id,title')
                        ->orderBy('students.class_id','desc')
                        ->whereRaw($where)
                        ->get();
        }else{

            $students = collect();
            foreach($assignedClasses as $row){
            $student = Student::with('class_name:id,title','section_name:id,title', 'parent_name', 'category_name:id,title')
                ->where('class_id',$row->class_id)
                ->whereIn('section_id',explode(',',$row->sections))
                ->get();
                $students = $students->merge($student);
            }
        //    return $students;
                    // Fetch students associated with the teacher's assigned classes and sections
      
                    // ->whereHas('section', function ($query) use ( $assignedSectionIds) {
                    // $query->whereIn('id',  $assignedSectionIds);
                    // })
               
                
            // $student = Student::with('class_name','section_name','parent_name','category_name')
           
            //            ->orderBy('class_id','desc')
            //            ->get();
        }
        return view('staff.student-list',['students'=>$students,'assign_class'=>$assignedClasses,'academicYear'=>$academicYear,'class'=>$stdClass,'$section'=>$section]);
    }
 
    public function yb_logout(Request $req) {
        Auth::logout();
        session()->forget('id');
        session()->forget('f_name');
        return redirect('staff/login');
    }




    // public function yb_xyz(Request $request){
    //     // Get the ID of the currently logged-in teacher from the session
    //     $teacherId = session()->get('id');
    
    //     // Fetch all classes assigned to the teacher
    //     $assignedClasses = AssignClassTeacher::where('staff_id', $teacherId)->pluck('class_id');
    
    //     // Fetch all sections corresponding to the assigned classes
    //     $assignedSections = Section::whereIn('class_id', $assignedClasses)->pluck('id');
    
    //     // Build the WHERE clause to filter students by assigned sections
    //     $whereConditions = [];
    //     if ($request->class_id) {
    //         // Ensure the requested class is within the assigned classes
    //         if ($assignedClasses->contains($request->class_id)) {
    //             $whereConditions['class_id'] = $request->class_id;
    //         }
    //     }
    //     if ($request->section_id) {
    //         // Ensure the requested section is within the assigned sections
    //         if ($assignedSections->contains($request->section_id)) {
    //             $whereConditions['section_id'] = $request->section_id;
    //         }
    //     }
    //     if ($request->std_name) {
    //         $whereConditions['first_name'] = $request->std_name;
    //     }
    //     if ($request->roll_no) {
    //         $whereConditions['roll_no'] = $request->roll_no;
    //     }
    
    //     // Fetch students based on the constructed WHERE conditions
    //     $students = Student::with('class_name', 'section_name', 'parent_name', 'category_name')
    //         ->where($whereConditions)
    //         ->orderBy('class_id', 'desc')
    //         ->get();
    
    //     // Fetch academic years, standard classes, and all sections (for display purposes)
    //     $academicYears = AcademicYear::all();
    //     $standardClasses = StdClass::all();
    //     $sections = Section::all();
    
    //     // Pass the fetched data to the view for rendering
    //     return view('staff.student-list', [
    //         'students' => $students,
    //         'academicYear' => $academicYears,
    //         'class' => $standardClasses,
    //         'section' => $sections
    //     ]);
    // }
}
