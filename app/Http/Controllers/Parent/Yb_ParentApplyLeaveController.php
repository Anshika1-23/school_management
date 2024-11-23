<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StdApplyLeave;
use App\Models\LeaveType;
use App\Models\ApplyLeave;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_ParentApplyLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $parent = session()->get('id');
        $students = Student::select('id','first_name','last_name')->where('parent_id', $parent)->get();
        if ($request->ajax()) {
                $student_ids = []; 
                foreach($students as $item){
                    array_push( $student_ids,$item->id);
                }
            $data = StdApplyLeave::with('leave_title','student_name:id,first_name,last_name')->latest()
                    ->whereIn('student_id', $student_ids)
                    ->get();
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
        return view('parent.parent-apply-leaves',['LeaveType'=>$LeaveType,'student'=>$students]); 
    }

    public function yb_getSingle_leave($id){
        $leave = stdApplyLeave::with('leave_title')->where(['id'=>$id])->latest()->get();
        return $leave;
    }

}
