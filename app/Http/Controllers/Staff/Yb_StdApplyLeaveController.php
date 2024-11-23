<?php

namespace App\Http\Controllers\Staff;

use App\Models\StdApplyLeave;
use App\Models\LeaveType;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_StdApplyLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = StdApplyLeave::with('leave_title','student_name')->latest()->get();
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
                ->addColumn('student', function($row){
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
                    // -1 for Canceled and 1 for Approved
                    if($row->approve_status == '-1' || $row->approve_status == '1'){ 
                        $btn = '<button data-url="'.url('student/leaves/').'" data-id="'.$row->id.'" class="view_leave btn btn-primary btn-sm"><i class="bi bi-pencil"></i></button>'; 
                    }else{  
                        $btn = '<button data-url="'.url('staff').'" data-value="1" data-id="'.$row->id.'" class="change_status btn btn-success btn-sm mb2"><i class="bi bi-check"></i></button>
                                <button data-url="'.url('staff').'" data-value="-1" data-id="'.$row->id.'" class="change_status btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
                                <button data-url="'.url('student/leaves/').'" data-id="'.$row->id.'" class="view_leave btn btn-primary btn-sm"><i class="bi bi-eye"></i></button>';  
                    }
                  return $btn;
                })
                ->rawColumns(['approve_status','action'])
                ->make(true);
        }
        return view('staff.std_apply_leave.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $LeaveType = LeaveType::all();
        return view('std_apply_leave.create',['LeaveType'=>$LeaveType]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
      //  return $request->input();
       
        $stdApplyLeave = new StdApplyLeave();
        $stdApplyLeave->apply_date = $request->input("applyDate");
        $stdApplyLeave->leave_from = $request->input("from_date");
        $stdApplyLeave->leave_to = $request->input("to_date");
        $stdApplyLeave->approve_status = $request->input("leave_type");
        $stdApplyLeave->reason = $request->input("reason");
        $result =  $stdApplyLeave->save();
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

    public function yb_view(Request $request)
    {   
        $LeaveType = LeaveType::all();
        $student = session()->get('id');
        if ($request->ajax()) {
           
            $data = StdApplyLeave::with('leave_title')->latest()
                    ->where('student_id', $student)
                    ->orderBy('id','desc')->get();
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
                    $btn = '<button data-url="'.url('student/leaves/').'" data-id="'.$row->id.'" class="view_stdleave btn btn-primary btn-sm">View</button>';
                    return $btn;
                })
                ->rawColumns(['approve_status','action'])
                ->make(true);
        }
        return view('student.student-leave',['LeaveType'=>$LeaveType]); 
    }

    public function yb_getSingle_leave($id){
        $leave = StdApplyLeave::with('leave_title')->where(['id'=>$id])->latest()->get();
        return $leave;
    }

    public function yb_changeLeave_status(Request $request){
        $update_leave = StdApplyLeave::where(['id'=>$request->input('id')])->update($request->input());
        return  $update_leave; 
    }
}
