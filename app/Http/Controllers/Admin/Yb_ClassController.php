<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StdClass;
use App\Models\Section;
use App\Models\Student;
use App\Http\Requests\ClassRequest;
use App\Models\Subject;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Yb_ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           $data = StdClass::select('classes.*',DB::raw("GROUP_CONCAT(DISTINCT sections.title ORDER BY sections.id SEPARATOR ',') AS section_list"))
           ->leftJoin('sections', function ($join) {
               $join->on(DB::raw("FIND_IN_SET(sections.id, classes.section)"), '>', DB::raw("'0'"));
           })
           ->latest()
           ->groupBy('classes.id')
           ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            // ->addColumn('section', function($row){
            //     return $row->class_section->title;
            // })
            ->editColumn('status', function($row){
                if($row->status == '1'){
                    $status = '<label class="badge bg-light-success">Active</label>';
                }else{
                    $status = '<label class="badge bg-light-danger">Inactive</label>';
                }
                return $status;
            })
            ->addColumn('action', function($row){
                $btn = '<a href="classes/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-class btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        }
        return view('admin.class.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $section = Section::all();
        return view('admin.class.create',['section'=>$section]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRequest $request)
    {
        $subjects = null;
        if($request->subjects){
            $subjects = implode(',',$request->subjects);
        }
        $stdClass = new StdClass();
        $stdClass->title = $request->title;
        $stdClass->section= implode(',',$request->section); 
        $result = $stdClass->save();
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
        $section = Section::all();
        $stdClass = StdClass::where(['id'=>$id])->first();
        return view('admin.class.edit',['class'=>$stdClass,'section'=>$section,'subjects'=>$subjects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRequest $request, string $id)
    {
       
        $stdClass = StdClass::where(['id'=>$id])->update([
            "title" => $request->title,
            "section"=> implode(',',$request->section),
            "status" => $request->status,
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student_count = Student::where('class_id',$id)->count();
        if($student_count > 0){
            return "You won't delete this class because this class is assigned to students.";
        }else{
            $destroy = StdClass::where('id',$id)->delete();
            return  $destroy;
        }
    }


    public function yb_ClassReport(Request $request){
        $stdClass =StdClass::all();
        if($request->input()){
           $student = Student::where(['class_id'=>$request->input('stdclass'),'section_id'=>$request->input('section')])->count();
           return $student;
        }else{
            return view('admin.reports.class-report',['class'=>$stdClass]);
        }
    }
}
