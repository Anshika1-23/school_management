<?php

namespace App\Http\Controllers\Staff;

use App\Models\StudentCategory;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCatRequest;
use Yajra\DataTables\DataTables;

class Yb_StudentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StudentCategory::latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editStudentCategory btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-studentCategory btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('staff.student_category.index');
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
    public function store(StudentCatRequest $request)
    {
        $category = new StudentCategory();
        $category->title = $request->title;
        $result = $category->save();
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentCategory $studentCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentCategory $studentCategory)
    {
        return $studentCategory;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentCatRequest $request, StudentCategory $studentCategory)
    {
        $category = StudentCategory::find($studentCategory->id);
        $category->title = $request->title;
        $save = $category->save();
        return $save;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentCategory $studentCategory)
    {
        $destroy = StudentCategory::where('id',$studentCategory->id)->delete();
        return  $destroy;
    }
}
