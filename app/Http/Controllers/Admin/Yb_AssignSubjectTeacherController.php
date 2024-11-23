<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StdClass;
use App\Models\Section;
use App\Models\Staff;
use App\Models\Subject;
use App\Models\AssignSubjectTeacher;
use App\Http\Requests\AssignSubjectTeacherRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_AssignSubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
        //
        public function index()
        {
            $classes = StdClass::all();
            return view('admin.assign-subject-teacher.index',compact('classes'));
        }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $stdClass = StdClass::all();
        $section = Section::all();
        $teachers = Staff::all();
        $subjects = Subject::all();
        return view('admin.assign-subject-teacher.create',['class'=>$stdClass,'section'=>$section,'teachers'=>$teachers,'subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        AssignSubjectTeacher::where(['class_id'=>$request->class,'section_id'=>$request->section])->delete();
        if($request->subject){
            $data = [];
            $subject_count = count($request->subject);
            for($i=0;$i<$subject_count;$i++){
                $data[$i] = [
                    'class_id' => $request->class,
                    'section_id' => $request->section,
                    'subject_id' => $request->subject[$i],
                    'staff_id' => $request->teacher[$i],
                ];
            }
            AssignSubjectTeacher::insert($data);
        }
        return '1';
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $class_subjects = StdClass::where('id',$request->class)->pluck('subjects')->first();
        $class_sub_arr = array_filter(explode(',',$class_subjects));
        $subjects = Subject::whereIn('id',$class_sub_arr)->get();
        $teachers = Staff::all();
        $class = $request->class;
        $section = $request->section;
        $assigned = AssignSubjectTeacher::with('subject_name:id,title','staff_name:id,f_name,l_name')->where(['class_id'=>$class,'section_id'=>$section])->get();
        if($request->type == 'table'){
            return view('admin.assign-subject-teacher.assigned-table',compact('assigned'));
        }else{
            return view('admin.assign-subject-teacher.assigned-form',compact('subjects','teachers','assigned','class','section'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssignSubjectTeacherRequest $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }
}
