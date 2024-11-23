<?php

namespace App\Http\Controllers\Staff;
use Illuminate\Support\Facades\File;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\ParentDetail;
use App\Models\AcademicYear;
use App\Models\StdClass;
use App\Models\Section;
use App\Models\Religion;
use App\Models\StudentCategory;
use App\Models\BloodGroups;
use App\Http\Requests\StudentRequest;
use Yajra\DataTables\DataTables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Yb_StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Student::latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('gender', function($row){
                    if($row->gender == '1'){
                        $gender = '<label class="badge bg-light-secondary">Male</label>';
                    }else{
                        $gender = '<label class="badge bg-light-info">Female</label>';
                    }
                    return $gender;
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
                    $btn = '<a href="students/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-student btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['gender','status','action'])
                ->make(true);
        }
        return view('staff.student.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $academicYear = AcademicYear::all();
        $stdClass = StdClass::all();
        $section = Section::all();
        $religion = Religion::all();
        $parentDetail = ParentDetail::all();
        $bloodGroups = BloodGroups::all();
        $studentCategory = StudentCategory::all();
        //$student = Student::select('admission_no')->first();
        $adm_no = Student::max('admission_no');
        if($adm_no != null){
            $adm_no++;
        }else{
            $adm_no= 1;
        }
        $academicYear = AcademicYear::all();
        //return dd($student);
        return view('staff.student.create',['academic'=>$academicYear,'class'=>$stdClass,'section'=>$section,'religion'=>$religion,'category'=>$studentCategory,'blood'=>$bloodGroups,'parent'=>$parentDetail,'admission'=>$adm_no]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        //
        //return $request->input();
        if($request->img){
            $image = $request->img->getClientOriginalName();
            $request->img->move(public_path('student'),$image);
        }else {
            $image = "";
        }

        $student = new Student();
        $student->student_photo = $image;
        $student->academic_id = $request->academic_year;
        $student->class_id = $request->stdClass;
        $student->section_id = $request->section; 
        $student->admission_no = $request->admission_no;
        $student->admission_date = $request->admission_date;
        $student->roll_no = $request->roll_no;
        $student->first_name = $request->f_name;
        $student->last_name = $request->l_name;
        $student->parent_id = $request->parent;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->dob;
        $student->birth_certificate_no = $request->birth_certificate_no;
        $student->national_id_no = $request->national_no;
        $student->religion_id = $request->religion;
        $student->caste = $request->caste;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->phone = $request->phone;
        $student->current_address = $request->address;
        $student->permanent_address = $request->permanent_address;
        $student->bloodgroup_id = $request->blood;
        $student->student_category_id = $request->category;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $result = $student->save();
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
        $academicYear = AcademicYear::all();
        $stdClass = StdClass::all();
        $section = Section::all();
        $religion = Religion::all();
        $bloodGroups = BloodGroups::all();
        $parentDetail = ParentDetail::all();
        $studentCategory = StudentCategory::all();
        $academicYear = AcademicYear::all();
        $student = Student::where(['id'=>$id])->first();
        return view('staff.student.edit',['student'=>$student,'academic'=>$academicYear,'class'=>$stdClass,'section'=>$section,'religion'=>$religion,'category'=>$studentCategory,'blood'=>$bloodGroups,'parent'=>$parentDetail]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        //
         // Update Student Image
         if($request->img != ''){        
            $path = public_path().'/student/';
            //code for remove old file
            if($request->old_img != ''  && $request->old_img != null){
                $file_old = $path.$request->old_img;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->img;
            $image = $request->img->getClientOriginalName();
            $file->move($path, $image);
        }else{
            $image = $request->old_img;
        }

        $student = Student::where(['id'=>$id])->update([
            "student_photo" => $image,
            "academic_id" => $request->academic_year,
            "class_id" => $request->stdClass,
            "section_id" => $request->section, 
            "admission_no" => $request->admission_no,
           "admission_date" => $request->admission_date,
            "roll_no" => $request->roll_no,
            "first_name" => $request->f_name,
            "last_name" => $request->l_name,
            "parent_id" => $request->parent,
            "gender" => $request->gender,
            "date_of_birth" => $request->dob,
            "birth_certificate_no" => $request->birth_certificate_no,
            "national_id_no" => $request->national_no,
            "religion_id" => $request->religion,
            "caste" => $request->caste,
           // "email" => $request->email,
            "phone" => $request->phone,
            "current_address" => $request->address,
            "permanent_address" => $request->permanent_address,
            "bloodgroup_id" => $request->blood,
            "student_category_id" => $request->category,
            "height" => $request->height,
            "weight" => $request->weight,
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
        $imagePath = Student::select('student_photo')->where('id', $id)->first();
        $filePath = public_path().'/student/'.$imagePath->image;
        File::delete($filePath);
        $destroy = Student::where('id',$id)->delete();
        return  $destroy;
    }
}
