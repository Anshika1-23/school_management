<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StdClass;
use App\Models\Section;
use App\Models\Staff;
use App\Models\AssignClassTeacher;
use App\Http\Requests\AssignClassTeacherRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_AssignClassTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {
        //
    // return  $data = AssignClassTeacher::with('class_name','section_name','staff_name')->latest()->get();
        if ($request->ajax()) {
            $data = AssignClassTeacher::with('class_name','section_name','staff_name')->latest()->get();
                    return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('class', function($row){
                        return $row->class_name->title;
                    })
                    ->addColumn('section', function($row){
                        return $row->section_name->title;
                    })
                    ->addColumn('staff', function($row){
                        return $row->staff_name->f_name;
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
                        $btn = '<a href="assign-class-teacher/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-assignClassTeacher btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
        }
        return view('admin.assign-class-teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $stdClass = StdClass::all();
        $section = Section::all();
        $staff = Staff::all();
        return view('admin.assign-class-teacher.create',['class'=>$stdClass,'section'=>$section,'teacher'=>$staff]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignClassTeacherRequest $request)
    {
        //

        // Check if the teacher is already assigned to the specified class
        $existingAssignment = AssignClassTeacher::where('class_id', $request->class_id)
                                    ->where('section_id', $request->section)
                                    ->exists();

       // If the teacher is already assigned to the class, return false
        if ($existingAssignment) {
            return 'Assigned';
        }else{
            $assignClassTeacher = new AssignClassTeacher();
            $assignClassTeacher->class_id = $request->class_id;
            $assignClassTeacher->section_id = $request->section;
            $assignClassTeacher->staff_id = $request->teacher;
            $result = $assignClassTeacher->save();
            return $result;
        }
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
        $stdClass = StdClass::all();
        $section = Section::all();
        $staff = Staff::all();
        $assignClassTeacher = AssignClassTeacher::where(['id'=>$id])->first();
        return view('admin.assign-class-teacher.edit',['assignTeacher'=>$assignClassTeacher,'class'=>$stdClass,'section'=>$section,'teacher'=>$staff]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssignClassTeacherRequest $request, string $id)
    {
        //
        $assignClassTeacher = AssignClassTeacher::where(['id'=>$id])->update([
            "class_id" => $request->class_id,
            "section_id"=> $request->section,
            "staff_id"=> $request->teacher,
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
        $destroy = AssignClassTeacher::where('id',$id)->delete();
        return  $destroy;
    }
}
