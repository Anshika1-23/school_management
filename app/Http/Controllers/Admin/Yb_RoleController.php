<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\RoleRequest;
use App\Models\ParentDetail;
use App\Models\Staff;
use App\Models\StdClass;
use App\Models\Student;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Yb_RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Role::orderBy('id')->get();
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
            ->addColumn('action', function($row){
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editRole btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-role" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.role.index');
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
    public function store(RoleRequest $request)
    {
        //
        $role = new Role();
        $role->title = $request->title;
        $result = $role->save();
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
        $role = Role::where(['id'=>$id])->first();
        return $role;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        //
        $role = Role::where(['id'=>$id])->update([
            "title"=>$request->title,
            "status"=>$request->status,
        ]);
        return $role;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Role::where('id',$id)->delete();
        return  $destroy;
    }

    public function yb_login_permission(Request $request){
        if($request->input()){
            $class = null;
            $section = null;
            $role = $request->role;
            if($role != '2'){
                $staff = Staff::select('role','id','email','f_name','l_name','login_permission')->with('role_name')->where('role',$role)->get();
                return view('admin.role.staff-table',compact('staff','role'));
            }else{
                $class = $request->class;
                $section = $request->section;
                $students  = Student::select('parent_id','id','admission_no','roll_no','first_name','last_name','login_permission','class_id','section_id')->with('parent_name:id,login_permission','class_name','section_name')->where(['class_id'=>$class,'section_id'=>$section])->get();
                return view('admin.role.student-table',compact('students','class','section'));
            }
        }
        $roles = Role::all();
        $classes = StdClass::all();
        return view('admin.role.permission',compact('roles','classes'));
    }

    public function yb_set_staff_loginPermission(Request $request){
        $role = $request->role;
        $status = $request->status;
        Staff::where('role',$role)->update([
            'login_permission' => $status
        ]);
        return '1';
    }

    public function yb_set_singleStaff_loginPermission(Request $request){
        $id = $request->id;
        $status = $request->status;
        Staff::where('id',$id)->update([
            'login_permission' => $status
        ]);
        return '1';
    }

    public function yb_set_loginPermission(Request $request){
        // return $request;
        $id = $request->id;
        $status = $request->status;
        $type = $request->type;
        if($type == 'student'){
            Student::where('id',$id)->update([
                'login_permission' => $status
            ]);
        }elseif($type == 'parent'){
            ParentDetail::where('id',$id)->update([
                'login_permission' => $status
            ]);
        }else{
            Staff::where('id',$id)->update([
                'login_permission' => $status
            ]);
        }
        
        return '1';
    }

    public function yb_set_loginPassword(Request $request){
        $id = $request->id;
        $pass = $request->pass;
        $type = $request->type;
        if($type == 'student'){
            Student::where('id',$id)->update([
                'password' => Hash::make($pass)
            ]);
        }elseif($type == 'parent'){
            ParentDetail::where('id',$id)->update([
                'guardian_password' => Hash::make($pass)
            ]);
        }else{
            Staff::where('id',$id)->update([
                'password' => Hash::make($pass)
            ]);
        }
        
        return '1';
    }

    public function yb_reset_loginPassword(Request $request){
        $id = $request->id;
        $type = $request->type;
        if($type == 'student'){
            Student::where('id',$id)->update([
                'password' => Hash::make('123456')
            ]);
        }elseif($type == 'parent'){
            ParentDetail::where('id',$id)->update([
                'guardian_password' => Hash::make('123456')
            ]);
        }else{
            Staff::where('id',$id)->update([
                'password' => Hash::make('123456')
            ]);
        }
        
        return '1';
    }

    public function yb_resetAll_staffPassword(Request $request){
        $role = $request->role;
        Staff::where('role',$role)->update([
            'password' => Hash::make('123456')
        ]);
        return '1';
    }

    
    public function yb_set_allStudentsLoginPermission(Request $request){
        $status = $request->status;
        $class = $request->class;
        $section = $request->section;
        Student::where(['class_id'=>$class,'section_id'=>$section])->update([
            'login_permission' => $status
        ]);
        return '1';
    }

    public function yb_set_allParentsLoginPermission(Request $request){
        $status = $request->status;
        $class = $request->class;
        $section = $request->section;
        $parent_ids = Student::where(['class_id'=>$class,'section_id'=>$section])->pluck('parent_id')->toArray();
        ParentDetail::whereIn('id',$parent_ids)->update([
            'login_permission' => $status
        ]);
        return '1';
    }

    public function yb_reset_allStudentsPassword(Request $request){
        $class = $request->class;
        $section = $request->section;
        Student::where(['class_id'=>$class,'section_id'=>$section])->update([
            'password' => Hash::make('123456')
        ]);
        return '1';
    }

    public function yb_reset_allParentsPassword(Request $request){
        $class = $request->class;
        $section = $request->section;
        $parent_ids = Student::where(['class_id'=>$class,'section_id'=>$section])->pluck('parent_id')->toArray();
        ParentDetail::whereIn('id',$parent_ids)->update([
            'guardian_password' => Hash::make('123456')
        ]);
        return '1';
    }
}
