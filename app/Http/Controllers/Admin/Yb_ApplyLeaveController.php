<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApplyLeave;
use App\Models\LeaveType;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_ApplyLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
       // return  $data = ApplyLeave::with('leave_title','staff_username')->latest()->get();
        if ($request->ajax()) {
            $data = ApplyLeave::with('leave_title','staff_username')->latest()->get();
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
                ->addColumn('staff', function($row){
                    return $row->staff_username->f_name;
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
                        $btn = '<button data-url="'.url('staff/leaves/').'" data-id="'.$row->id.'" class="view_leave btn btn-primary btn-sm"><i class="bi bi-pencil"></i></button>'; 
                    }else{  
                        $btn = '<button data-url="'.url('admin').'" data-value="1" data-id="'.$row->id.'" class="change_status btn btn-success btn-sm mb2"><i class="bi bi-check"></i></button>
                                <button data-url="'.url('admin').'" data-value="-1" data-id="'.$row->id.'" class="change_status btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
                                <button data-url="'.url('staff/leaves/').'" data-id="'.$row->id.'" class="view_leave btn btn-primary btn-sm"><i class="bi bi-pencil"></i></button>';  
                    }
                  return $btn;
                })
                ->rawColumns(['approve_status','action'])
                ->make(true);
        }
        return view('admin.apply_leave.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $LeaveType = LeaveType::all();
        return view('apply_leave.create',['LeaveType'=>$LeaveType]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //return $request->input();
       
        $applyLeave = new ApplyLeave();
        $applyLeave->apply_date = $request->input("applyDate");
        $applyLeave->leave_from = $request->input("from_date");
        $applyLeave->leave_to = $request->input("to_date");
        $applyLeave->approve_status = $request->input("leave_type");
        $applyLeave->reason = $request->input("reason");
        $result =  $applyLeave->save();
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
     // return  $data = ApplyLeave::with('leave_type')->latest()->get();
     
        $LeaveType = LeaveType::all();
       
        $staff = session()->get('id');
        if ($request->ajax()) {
            //$data = ApplyLeave::latest('id')->get();
            $data = ApplyLeave::with('leave_title')->latest()
                    ->where('staff_id', $staff)
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
                    $btn = '<button data-url="'.url('staff/leaves/').'" data-id="'.$row->id.'" class="view_leave btn btn-primary btn-sm">View</button>';
                    return $btn;
                })
                ->rawColumns(['approve_status','action'])
                ->make(true);
        }
        return view('staff.staff-leave',['LeaveType'=>$LeaveType]); 
    }

    public function yb_getSingle_leave($id){
        $leave = ApplyLeave::with('leave_title')->where(['id'=>$id])->latest()->get();
        return $leave;
    }

    public function yb_changeLeave_status(Request $request){
           
        $update_leave = ApplyLeave::where(['id'=>$request->input('id')])->update($request->input());

        return  $update_leave; 
    }

}
