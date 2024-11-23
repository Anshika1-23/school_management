<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student;
use App\Http\Requests\SectionRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Section::orderBy('id')->get();
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
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editSection btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-section" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.section.index');
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
    public function store(SectionRequest $request)
    {
        //
        $section = new Section();
        $section->title = $request->title;
        $result = $section->save();
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
        $section = Section::where(['id'=>$id])->first();
        return $section;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        //
        $section = Section::where(['id'=>$id])->update([
            "title"=>$request->title,
            "status"=>$request->status,
        ]);
        return $section;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student_count = Student::where('section_id',$id)->count();
        if($student_count > 0){
            return "Yot won't delete this because this section is assigned to students";
        }else{
            $destroy = Section::where('id',$id)->delete();
            return  $destroy;
        }
    }
}
