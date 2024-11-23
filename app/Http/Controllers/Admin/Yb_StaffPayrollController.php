<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PayrollPayment;
use App\Models\Role;
use App\Models\Staff;
use App\Models\StaffPayroll;
use Yajra\DataTables\DataTables;

class Yb_StaffPayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Staff::where('staffs.role', $request->role)
                            ->with(['role_name', 'department_name', 'payroll' => function ($query) use ($request) {
                                $query->where('month', $request->month)
                                    ->where('year', $request->year);
                            }])
                            ->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role_title', function($row){
                    return $row->role_name->title;
                })
                ->addColumn('department_title', function($row){
                    if($row->department_name != null){
                        return $row->department_name->title;
                    }
                    return null;
                })
                ->addColumn('staff_name', function($row){
                    return $row->f_name.' '.$row->l_name;
                })
                ->editColumn('status', function($row){
                    if($row->payroll != null){
                        if($row->payroll->status == '0'){
                            return '<span class="badge bg-primary">Generated</label>';
                        }else{
                            return '<span class="badge bg-success">Paid</label>';
                        }
                    }else{
                        return '<span class="badge bg-warning">Not Generated</label>';
                    }
                })
                ->addColumn('action', function($row) use ($request){
                    $btn = '<div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="menuButton'.$row->id.'" data-bs-toggle="dropdown" aria-expanded="false">
                      Action
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="menuButton'.$row->id.'">';
                    if($row->payroll != null){
                        if($row->payroll->status == '0'){
                        $btn .= '<li><a class="dropdown-item" href="staff-payroll/pay/'.$row->payroll->id.'">Proceed to Pay</a></li>';
                        $btn .= '<li><a class="dropdown-item" href="staff-payroll/'.$row->payroll->id.'/edit">Edit</a></li>';
                        }
                        $btn .= '<li><a class="dropdown-item" href="staff-payroll/print/'.$row->payroll->id.'">Print</a></li>
                        ';
                    }else{
                        $btn .= '<li><a class="dropdown-item" href="staff-payroll/create/'.$row->id.'/'.$request->month.'/'.$request->year.'">Generate Payroll</a></li>';
                    }
                    $btn .= '</ul>
                  </div>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }else{
            $roles = Role::all();
            return view('admin.staff-payroll.index',compact('roles'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id,$month,$year)
    {
        $staff = Staff::with('role_name','designation_name','department_name')->where('id',$id)->first();
        return view('admin.staff-payroll.create',compact('staff','month','year'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        // return  print_r($request->input('deduct')[0]['type']);
        $earnings = 0;
        if($request->earnings != '0'){
            $earnings = json_encode($request->earn);
        }
        $deductions = 0;
        if($request->deductions != '0'){
            $deductions = json_encode($request->deduct);
        }
       

        $payroll = new StaffPayroll();
        $payroll->staff_id = $request->staff_id;
        $payroll->month = $request->month;
        $payroll->year = $request->year;
        $payroll->basic_salary = $request->basic_salary;
        $payroll->earnings = $earnings;
        $payroll->deductions = $deductions;
        $payroll->tax = $request->tax;
        $save = $payroll->save();
        return $save;
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
        // return $id;
        $payroll = StaffPayroll::with('staff_name')->where('id',$id)->first();

        // return $staff = Staff::with(['role_name','designation_name','department_name','payroll' => function ($query) use ($id) {
        //     $query->where('id', $id);
        // }])->toRawSql();
        return view('admin.staff-payroll.edit',compact('payroll'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->deductions;
        $earnings = 0;
        if($request->earnings !='0'){
            $earnings = json_encode($request->earn);
        }
        $deductions = 0;
        if($request->deductions != '0'){
            $deductions = json_encode($request->deduct);
        }
      
        
        $payroll = StaffPayroll::find($id);
        $payroll->basic_salary = $request->basic_salary;
        $payroll->earnings = $earnings;
        $payroll->deductions = $deductions;
        $payroll->tax = $request->tax;
        $save = $payroll->save();
        return $save;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function yb_pay_payroll_amount(Request $request,$id){
        if($request->input()){
            // return $request;
            $payment = new PayrollPayment();
            $payment->staff_id = $request->staff_id;
            $payment->payroll_id = $request->id;
            $payment->month = $request->month;
            $payment->year = $request->year;
            $payment->amount = $request->amount;
            $payment->method = $request->pay_method;
            $payment->note = $request->note;
            $save = $payment->save();

            StaffPayroll::where('id',$id)->update([
                'status' => '1'
            ]);

            return $save;

        }else{

            $payroll = StaffPayroll::with('staff_name')->where('id',$id)->first();
            return view('admin.staff-payroll.pay',compact('payroll'));
        }
    }

    public function yb_print_payroll($id){
        $payroll = StaffPayroll::with('staff_name','payment')->where('id',$id)->first();
        return view('admin.staff-payroll.print',compact('payroll'));
    }
}
