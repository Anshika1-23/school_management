<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Student;
use App\Models\LeaveType;
use App\Models\LeaveDefine;
use App\Models\ApplyLeave;
use App\Models\StdClass;
use App\Models\Section;
use App\Http\Requests\LeaveDefineRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_LeaveDefineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
           //$data = LeaveDefine::with('role_name','leaveType')->latest()->get();
           $data = LeaveDefine::with('role_name','leaveType')->select("leave_define.*")->selectRaw("IF(leave_define.leave_user = 'student', students.first_name, staffs.f_name) as username")
                            ->leftJoin('students', 'leave_define.user_id', '=', 'students.id')
                           ->leftJoin('staffs', 'leave_define.user_id', '=', 'staffs.id')   
                           ->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $status = '<label class="badge bg-light-success">Active</label>';
                    }else{
                        $status = '<label class="badge bg-light-danger">Inactive</label>';
                    }
                    return $status;
                })
                ->addColumn('role', function($row){
                    return $row->role_name->title;
                })
                ->addColumn('leaveType', function($row){
                    return $row->leaveType->title;
                })
               
                ->addColumn('action', function($row){
                    $btn = '<a href="l-define/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-LeaveDefine btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.leave-define.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $role = Role::all();
        $staff = Staff::all();
        $stdClass = StdClass::all();
        $section = Section::all();
        $leaveType = LeaveType::all();
        $student = Student::all();
        return view('admin.leave-define.create',['role'=>$role,'staff'=>$staff,'leave'=>$leaveType,'stdClass'=>$stdClass,'section'=>$section,'student'=>$student]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveDefineRequest $request)
    {
        //
        //return $request->input();
        $leaveDefine = new LeaveDefine();
        $leaveDefine->user_id = $request->user;
        $leaveDefine->role = $request->role;
        $leaveDefine->leave_type = $request->leave;
        if($leaveDefine->leave_user != ''){ 
            $leaveDefine->leave_user = 'staff';
        }else{
            $leaveDefine->leave_user = 'student';
        }
        $leaveDefine->days = $request->day;
        $result = $leaveDefine->save();
        return $result;
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
        $role = Role::all();
        $staff = Staff::all();
        $leaveType = LeaveType::all();
        $leaveDefine = LeaveDefine::where(['id'=>$id])->first();
        return view('admin.leave-define.edit',['define'=>$leaveDefine,'role'=>$role,'staff'=>$staff,'leave'=>$leaveType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $leaveDefine = LeaveDefine::where(['id'=>$id])->update([
            "user_id" => $request->user,
            "role" => $request->role,
            "leave_type" => $request->leave,
            "days" => $request->day,
            "status" => $request->status,
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = LeaveDefine::where('id',$id)->delete();
        return  $destroy;
    }

    public function yb_approve_leave(){
        return view('admin.approveLeave');
    }

    public function yb_pending_leave(Request $request ){
       //return $data = ApplyLeave::with('leave_title','staff_username')->latest()->get();
        if ($request->ajax()) {
            $data = ApplyLeave::with('leave_title','staff_username')->where('approve_status', '=', 0)->latest()->get();
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
                // ->addColumn('staff', function($row){
                //     return $row->staff_username->f_name;
                // })
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
                      
                        $btn = '<button data-url="'.url('admin').'" data-value="1" data-id="'.$row->id.'" class="change_status btn btn-success btn-sm">Approve</button>
                                <button data-url="'.url('admin').'" data-value="-1" data-id="'.$row->id.'" class="change_status btn btn-danger btn-sm">Reject</button>
                                <button data-url="'.url('staff/leaves/').'" data-id="'.$row->id.'" class="view_leave btn btn-primary btn-sm">View</button>';  
                   
                  return $btn;
                })
                ->rawColumns(['approve_status','action'])
                ->make(true);
        }
    
        return view('admin.pendingLeave');
    }
}
