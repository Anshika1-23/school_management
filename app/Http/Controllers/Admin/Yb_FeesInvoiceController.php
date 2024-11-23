<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeesInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\FeesGroupRequest;
use App\Models\FeesType;
use App\Models\FeesGroup;
use App\Models\StdClass;
use App\Models\Student;

class Yb_FeesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FeesInvoice::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('student_full_name',function($row){
                return $row->student_name->full_name.' ('.$row->student_name->admission_no.')';
            })
            ->editColumn('status',function($row){
                if($row->status == '0'){
                    return '<span class="badge bg-danger">Not Paid</span>';
                }else{
                    return '<span class="badge bg-success">Paid</span>';
                }
            })
            ->editColumn('created_at',function($row){
                return date('d M, Y',strtotime($row->created_at));
            })
            ->addColumn('action', function($row){
                $btn = '<div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="menuButton'.$row->id.'" data-bs-toggle="dropdown" aria-expanded="false">
                  Action
                </button>
                <ul class="dropdown-menu" aria-labelledby="menuButton'.$row->id.'">';
                $btn .= '<li><a class="dropdown-item" href="fees-invoice-list/'.$row->id.'">View</a></li>';
                if($row->status == '0'){
                $btn .= '<li><a class="dropdown-item" href="fees-invoice-list/'.$row->id.'/edit">Edit</a></li>';
                $btn .= '<li><a hred="javascript:void(0)" class="dropdown-item delete-fees-invoice" data-id="'.$row->id.'">Delete</a></li>';
                }
                
                $btn .= '</ul>
              </div>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        }
        return view('admin.fees-invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = FeesType::all();
        $groups = FeesGroup::all();
        $class = StdClass::all();
        return view('admin.fees-invoice.create',compact('types','groups','class'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $typ_arr = str_split($request->type,3);
        if($typ_arr[0] == 'typ'){
            $g_id = FeesType::where('id',$typ_arr[1])->pluck('group')->first();
        }else{
            $g_id = $typ_arr[1];
        }
        $types = $request->types;
        for($i=0;$i<count($types);$i++){
            $invoice = new FeesInvoice();
            $invoice->student = $request->student;
            $invoice->class = $request->class;
            $invoice->section = $request->section;
            $invoice->type_id = $types[$i]['type'];
            $invoice->group_id = $g_id;
            $invoice->amount = $types[$i]['amount'];
            $invoice->waiver = $types[$i]['waiver'];
            $invoice->status = $request->status;
            $invoice->due_date = $request->due_date;
            if($request->status == '1'){
                $invoice->pay_method = $request->pay_method;
                $invoice->payment_date = date('Y-m-d');
            }
            $invoice->note = $types[$i]['note'];
            $save = $invoice->save();
        }
        return '1';
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = FeesInvoice::with('student_details:id,first_name,last_name,class_id,section_id,roll_no,admission_no','class_name:id,title','section_name:id,title','type_name:id,title','group_name:id,title')->find($id);
        return view('admin.fees-invoice.view',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = FeesInvoice::with('student_name:id,first_name,last_name','class_name:id,title','section_name:id,title','type_name:id,title','group_name:id,title')->find($id);
        return view('admin.fees-invoice.edit',compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $invoice = FeesInvoice::find($id);
        $invoice->due_date = $request->due_date;
        $invoice->amount = $request->amount;
        $invoice->waiver = $request->waiver;
        $invoice->note = $request->note;
        $invoice->status = $request->status;
        if($request->status == '1'){
            $invoice->pay_method = $request->pay_method;
            $invoice->payment_date = date('Y-m-d');
        }
        $save = $invoice->save();
        return $save;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeesInvoice $feesInvoice)
    {
        //
    }

    public function yb_fees_type_markup(Request $request){
        $id_arr = str_split($request->id,3);
        if($id_arr[0] == 'grp'){
            $types = FeesType::where('group',$id_arr[1])->get();
        }else{
            $types = FeesType::where('id',$id_arr[1])->get();
        }
        return view('admin.fees-invoice.type-table',compact('types'));
    }

    public function yb_get_section_students(Request $request){
        $cls = $request->cls;
        $section = $request->section;
        $students = Student::select('id','first_name','last_name')->where(['class_id'=>$cls,'section_id'=>$section])->get();
        $output = '<option disabled selected value="">Select Student</option>';
        if(!empty($students)){
            foreach($students as $row){
                $output .= '<option value="'.$row->id.'">'.$row->full_name.'</option>';
            }
        }else{
            $output = '<option disabled selected value=">No Students Found</option>';
        }
        return $output;
    }
}
