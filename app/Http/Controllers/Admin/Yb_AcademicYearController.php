<?php

namespace App\Http\Controllers\Admin;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class Yb_AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AcademicYear::latest('id')->get();
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
                    $btn = '<a href="academic_years/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-academicYear btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.academic_years.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.academic_years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:academic_years,title',
            'year' => 'required|unique:academic_years,year',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $academicYear = new AcademicYear();
        $academicYear->title = $request->title;
        $academicYear->year = $request->year;
        $academicYear->start_date = $request->start_date;
        $academicYear->end_date = $request->end_date;
        $save = $academicYear->save();
        return $save;


    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicYear $academicYear)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic_years.edit',compact('academicYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'title' => 'required|unique:academic_years,title,'.$academicYear->id.',id',
            'year' => 'required|unique:academic_years,year,'.$academicYear->id.',id',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $year = AcademicYear::find($academicYear->id);
        $year->title = $request->title;
        $year->year = $request->year;
        $year->start_date = $request->start_date;
        $year->end_date = $request->end_date;
        $year->status = $request->status;
        $save = $year->save();
        return $save;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academicYear)
    {
        if($academicYear->status != '1'){
            $student_count = Student::where('academic_id',$academicYear)->count();
            if($student_count > 0){
                return "You won't delete this. This academic year assigned in students.";
            }else{
                $destroy = AcademicYear::where('id',$academicYear->id)->delete();
                return  $destroy;
            }
        }else{
            return "You won't delete this. This academic year ACTIVE year.";
        }
    }
    
}
