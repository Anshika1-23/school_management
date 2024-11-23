<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Staff;
use App\Http\Requests\StaffRequest;
use App\Models\StaffBankInfo;
use App\Models\StaffDocument;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return  $data = Staff::with('role_name','department_name','designation_name')->latest('id')->get();
        if ($request->ajax()) {
            $data = Staff::with('role_name','department_name','designation_name')->latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name',function($row){
                    return $row->full_name;
                })
                ->addColumn('role_title',function($row){
                    if($row->role_name != null){
                        return $row->role_name->title;
                    }else{
                        return null;
                    }
                })
                ->addColumn('department_title',function($row){
                    if($row->department_name != null){
                        return $row->department_name->title;
                    }else{
                        return null;
                    }
                })
                ->addColumn('designation_title',function($row){
                    if($row->designation_name != null){
                        return $row->designation_name->title;
                    }else{
                        return null;
                    }
                })
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $status = '<label class="badge bg-light-success">Active</label>';
                    }else{
                        $status = '<label class="badge bg-light-danger">Inactive</label>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="staffs/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-staff btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $role = Role::all();
        $department = Department::all();
        $designation = Designation::all();
        return view('admin.staff.create',['role'=>$role,'department'=>$department,'designation'=>$designation]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffRequest $request)
    {
        // upload staff photo
        $image = yb_upload_img($request->img,'staff');
        

        $staff = new Staff();
        $staff->img = $image;
        $staff->f_name = $request->f_name;
        $staff->l_name= $request->l_name; 
        $staff->father_name = $request->father_name;
        $staff->mother_name = $request->mother_name;
        $staff->role = $request->role;
        $staff->department = $request->department;
        $staff->designation = $request->designation;
        $staff->email = $request->email;
        $staff->password = Hash::make('123456');
        $staff->gender = $request->gender;
        $staff->dob = $request->dob;
        $staff->date_of_joining = $request->doj;
        $staff->mobile = $request->mobile;
        $staff->emergency_mobile = $request->emg_mobile;
        $staff->driving_license = $request->driving_license;
        $staff->address = $request->address;
        $staff->permanent_address = $request->permanent_address;
        $staff->qualification = $request->qualification;
        $staff->experience = $request->experience;
        $staff->marital_status = $request->m_status;
        $result = $staff->save();

        // upload staff resume file
        $resume = yb_upload_img($request->resume,'resume');
        // upload join letter file
        $join_letter = yb_upload_img($request->join_letter,'join-letter');
        // upload other doc file
        $other_doc = yb_upload_img($request->other_doc,'other-documents');

        $doc = new StaffDocument();
        $doc->staff_id = $staff->id;
        $doc->resume = $resume;
        $doc->join_letter = $join_letter;
        $doc->other_doc = $other_doc;
        $doc->save();

        $doc = new StaffBankInfo();
        $doc->staff_id = $staff->id;
        $doc->bank_name = $request->bank_name;
        $doc->account_name = $request->account_name;
        $doc->account_num = $request->account_num;
        $doc->bank_ifsc = $request->bank_ifsc;
        $doc->save();


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
        $department = Department::all();
        $designation = Designation::all();
        $staff = Staff::with('bank_info','doc_info')->find($id);
        return view('admin.staff.edit',['staff'=>$staff,'role'=>$role,'department'=>$department,'designation'=>$designation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StaffRequest $request, string $id)
    {
         // upload staff photo
        if($request->img){
            if($request->old_staff_img != ''){
                yb_remove_img($request->old_staff_img,'staff');
            }
            $image = yb_upload_img($request->img,'staff');
        }else{
            $image = $request->old_staff_img;
        }

         

        $staff = Staff::find($id);
        $staff->img = $image;
        $staff->f_name = $request->f_name;
        $staff->l_name= $request->l_name; 
        $staff->father_name = $request->father_name;
        $staff->mother_name = $request->mother_name;
        $staff->role = $request->role;
        $staff->department = $request->department;
        $staff->designation = $request->designation;
        $staff->email = $request->email;
        $staff->gender = $request->gender;
        $staff->dob = $request->dob;
        $staff->date_of_joining = $request->doj;
        $staff->mobile = $request->mobile;
        $staff->emergency_mobile = $request->emg_mobile;
        $staff->driving_license = $request->driving_license;
        $staff->address = $request->address;
        $staff->permanent_address = $request->permanent_address;
        $staff->qualification = $request->qualification;
        $staff->experience = $request->experience;
        $staff->marital_status = $request->m_status;
        $result = $staff->save();

        // upload staff resume file
        if($request->resume){
            if($request->old_resume != ''){
                yb_remove_img($request->old_resume,'resume');
            }
            $resume = yb_upload_img($request->resume,'resume');
        }else{
            $resume = $request->old_resume;
        }
        
        // upload join letter file
        if($request->join_letter){
            if($request->old_join_letter != ''){
                yb_remove_img($request->old_join_letter,'join-letter');
            }
            $join_letter = yb_upload_img($request->join_letter,'join-letter');
        }else{
            $join_letter = $request->old_join_letter;
        }
        
        // upload other doc file
        if($request->other_doc){
            if($request->old_other_doc != ''){
                yb_remove_img($request->old_other_doc,'other-documents');
            }
            $other_doc = yb_upload_img($request->other_doc,'other-documents');
        }else{
            $other_doc = $request->old_other_doc;
        }
        

        $doc = StaffDocument::find($request->doc_id);
        $doc->staff_id = $staff->id;
        $doc->resume = $resume;
        $doc->join_letter = $join_letter;
        $doc->other_doc = $other_doc;
        $doc->save();

        $doc = StaffBankInfo::find($request->bank_id);
        $doc->staff_id = $staff->id;
        $doc->bank_name = $request->bank_name;
        $doc->account_name = $request->account_name;
        $doc->account_num = $request->account_num;
        $doc->bank_ifsc = $request->bank_ifsc;
        $doc->save();

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Staff::where('id',$id)->delete();
        return  $destroy;
    }
}
