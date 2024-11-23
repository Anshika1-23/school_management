<?php

namespace App\Http\Controllers\Admin;
use App\Models\Role;
use App\Models\Staff;
use App\Models\StaffAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Yb_StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $role = Role::all();
        return view('admin.staff-attendance.index',['role'=>$role]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //

        //return $request->input();
        $staff = Staff::with('role_name')->where('role',$request->role)->latest()->get();
        $staffAttendance = StaffAttendance::select('staff_id')->where(['role'=>$request->input('role') , 'attendence_date'=>$request->input('date')])->pluck('staff_id')->toArray();
         //return $staffAttendance;
        return view('admin.staff-attendance.view-attendance',['date'=>$request->date,'role'=> $staff,'attendance'=>$staffAttendance]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
     //return var_dump($request->attendance[$request->staff_id[0]]);
        // $request->validate([
        //     'staff_id'=>'required',
        //    // 'date'=>'required',
        // ]);

        for($i = 0;$i <count($request->staff_id); $i++){
            $staffAttendance =  StaffAttendance::updateOrCreate(['staff_id'=>$request->staff_id[$i],'attendence_date'=>$request->date[$i] ]);
            if(date('l',strtotime($request->date[$i])) != 'Sunday'){
                $staffAttendance->attendence_type = $request->attendance[$request->staff_id[$i]];
            }
            $staffAttendance->description = $request->description[$i];
            $staffAttendance->attendence_date = $request->date[$i];
            $staffAttendance->staff_id = $request->staff_id[$i];
            $staffAttendance->role = $request->role_id[$i];
            $staffAttendance->save();
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

    public function staff_AttendanceReport(Request $request){
        if($request->input()){
           // return $request->input();
           $staff = Staff::with('role_name')->where('role',$request->role)->latest()->get();
           $month= (explode("-",$request->input('month')));
           $daysInMonth=cal_days_in_month(CAL_GREGORIAN,$month[1],$month[0]);
           // Retrieve the IDs of all staff members
          $staffIds = $staff->pluck('id')->toArray();
          // Use the staff IDs to filter attendance records
          $staffAtt = StaffAttendance::whereIn('staff_id', $staffIds)->get();

          return view('admin.staff-attendance.show-attendance-report',['month'=> $month,'staff'=>$staff,'daysInMonth' =>$daysInMonth,'staffAtt'=>$staffAtt]);
        }else{
            $role = Role::all();
            return view('admin.staff-attendance.attendance-report',['role'=>$role]);
        }
      
    }
}
