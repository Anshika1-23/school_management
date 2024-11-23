<?php

namespace App\Http\Controllers\Admin;
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
use App\Models\StdApplyLeave;
use App\Models\Religion;
use App\Models\StudentCategory;
use App\Models\BloodGroups;
use App\Models\DocumentInfo;
use App\Models\BankInfo;
use App\Http\Requests\StudentRequest;
use Yajra\DataTables\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Staff;
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
            $data = Student::with('class_name','section_name')->latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name',function($row){
                    return $row->full_name;
                })
                ->addColumn('class_title',function($row){
                    return $row->class_name->title;
                })
                ->addColumn('section_title',function($row){
                    return $row->section_name->title;
                })
                ->editColumn('gender', function($row){
                    if($row->gender == '0'){
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
        return view('admin.student.index');
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
        $staff_list = Staff::with('department_name','designation_name')->where('status','1')->get();
        //return dd($student);
        return view('admin.student.create',['academic'=>$academicYear,'class'=>$stdClass,'section'=>$section,'religion'=>$religion,'category'=>$studentCategory,'blood'=>$bloodGroups,'admission'=>$adm_no,'staff_list'=>$staff_list]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        //
    //    return $request->input();
       
        // Add Student Image
        $std_img = yb_upload_img($request->std_img,'student');

        // Add Father Image
        $f_image = yb_upload_img($request->father_img,'father');
      
        // Add Mother Image
        $m_image = yb_upload_img($request->mother_img,'mother');
              
        // Add Guardian Image
        $image = yb_upload_img($request->img,'guardian');
        if($request->old_parent_id == ''){
            $parentDetail = new ParentDetail();
            $parentDetail->father_img = $f_image;
            $parentDetail->father_name = $request->f_name;
            $parentDetail->f_occupation = $request->f_occupation;
            $parentDetail->father_phoneNumber = $request->f_phone;
    
            $parentDetail->mother_img = $m_image;
            $parentDetail->mother_name = $request->m_name;
            $parentDetail->m_occupation = $request->m_occupation;
            $parentDetail->mother_phoneNumber = $request->m_phone;
    
            $parentDetail->guardian_relation = $request->guardian_relation;
            $parentDetail->guardian_name = $request->guardian_name;
            $parentDetail->guardian_email = $request->guardian_email;
            $parentDetail->guardian_password = Hash::make($request->guardian_password);
            $parentDetail->guardian_img =  $image;
            $parentDetail->guardian_phone = $request->guardian_phone;
            $parentDetail->guardian_occupation = $request->guardian_occupation;
            $parentDetail->guardian_address = $request->guardian_address;
            $result1 = $parentDetail->save();
            $parent_id = $parentDetail->id;
        }else{
            $parent_id = $request->old_parent_id;
        }

        $student = new Student();
        $student->student_photo = $std_img;
        $student->academic_id = $request->academic_year;
        $student->class_id = $request->stdClass;
        $student->section_id = $request->section; 
        $student->admission_no = $request->admission_no;
        $student->admission_date = $request->admission_date;
        $student->roll_no = $request->roll_no;
        $student->first_name = $request->std_name;
        $student->last_name = $request->l_name;
        $student->parent_id = $parent_id;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->dob;
        // $student->birth_certificate_no = $request->birth_certificate_no;
        //$student->national_id_no = $request->national_no;
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
       // return $result;


     

        // check documents Info
        if($request->national_doc){
            $national_doc = yb_upload_img($request->national_doc,'document-info');
        }else{
            $national_doc="";
        }

        if($request->birth_doc){
            $birth_doc= yb_upload_img($request->birth_doc,'document-info');
        }
        else{
            $birth_doc="";
        }

        // insert document file names
        $documentInfo = new DocumentInfo();
        $documentInfo->std_id =$student->id;
        $documentInfo->national_id_no =$request->national_no;;
        $documentInfo->national_doc = $national_doc;
        $documentInfo->birth_certificate_no = $request->birth_certificate_no;
        $documentInfo->birth_doc =  $birth_doc;
        $result2 =  $documentInfo->save();

        // insert bank details
        $bankInfo = new BankInfo();
        $bankInfo->std_id = $student->id;
        $bankInfo->bank_name = $request->bank;
        $bankInfo->bank_account_number = $request->account_no;
        $bankInfo->ifsc_code = $request->code;
        $result3 = $bankInfo->save();
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
        $academicYear = AcademicYear::all();
        $stdClass = StdClass::all();
        $section = Section::all();
        $religion = Religion::all();
        $bloodGroups = BloodGroups::all();
        $studentCategory = StudentCategory::all();
        $academicYear = AcademicYear::all();
        $staff_list = Staff::with('department_name','designation_name')->where('status','1')->get();
        $student = Student::find($id);
        
        $stu = $student->with('parent_name','bank_name','document_name')->find($id);
    //    return $stu;
    //    $student = Student::with('parent_name','bank_name','document_name')->where(['id'=>$id])->first();
        return view('admin.student.edit',['student'=>$stu,'academic'=>$academicYear,'class'=>$stdClass,'section'=>$section,'religion'=>$religion,'category'=>$studentCategory,'blood'=>$bloodGroups,'staff_list'=>$staff_list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        //
    //    return $request->input();
         // Update Student Image
         if($request->std_img != ''){   

            $path = public_path().'/student/';
            //code for remove old file
            if($request->old_std_img != ''  && $request->old_std_img != null){
                yb_remove_img($request->old_std_img,'student');
            }
            //upload new file
            $std_img = yb_upload_img($request->std_img,'student');
        }else{
            $std_img = $request->old_std_img;
        }
       
      
        // Update Father Image 
        if($request->father_img != ''){        
            $path = public_path().'/father/';
            //code for remove old file
            if($request->old_father_img != ''  && $request->old_father_img != null){
                yb_remove_img($request->old_father_img,'father');
            }
            //upload new file
            $f_image = yb_upload_img($request->father_img,'father');
        }else{
            $f_image = $request->old_father_img;
        }

        // Update Mother Image
        if($request->mother_img != ''){        
            $path = public_path().'/mother/';
            //code for remove old file
            if($request->old_mother_img != ''  && $request->old_mother_img != null){
                yb_remove_img($request->old_mother_img,'mother');
            }
            //upload new file
            $m_image = yb_upload_img($request->mother_img,'mother');
        }else{
            $m_image = $request->old_mother_img;
        }
         
        // Add Guardian Image
        if($request->img != ''){        
            $path = public_path().'/guardian/';
            //code for remove old file
            if($request->old_img != ''  && $request->old_img != null){
                yb_remove_img($request->old_img,'guardian');
            }
            //upload new file
            $image = yb_upload_img($request->img,'guardian');
        }else{
            $image = $request->old_img;
        }

        // Update National Document Image
        if($request->national_doc != ''){        
            $path = public_path().'/document-info/';
            //code for remove old file
            if($request->old_national_doc != ''  && $request->old_national_doc != null){
                yb_remove_img($request->old_national_doc,'document-info');
            }
            //upload new file
            $national_doc = yb_upload_img($request->national_doc,'document-info');
        }else{
            $national_doc = $request->old_national_doc;
        }

        // Update Birth Document Image
        if($request->birth_doc != ''){        
            $path = public_path().'/document-info/';
            //code for remove old file
            if($request->old_birth_doc != ''  && $request->old_birth_doc != null){
                yb_remove_img($request->old_birth_doc,'document-info');
            }
            //upload new file
            $birth_doc = yb_upload_img($request->birth_doc,'document-info');
        }else{
            $birth_doc = $request->old_birth_doc;
        }

        

        
        $student = Student::where(['id'=>$id])->update([
            "student_photo" => $std_img,
            "academic_id" => $request->academic_year,
            "class_id" => $request->stdClass,
            "section_id" => $request->section, 
            "admission_no" => $request->admission_no,
           "admission_date" => $request->admission_date,
            "roll_no" => $request->roll_no,
            "first_name" => $request->std_name,
            "last_name" => $request->l_name,
            "parent_id" => $parent_id,
            "gender" => $request->gender,
            "date_of_birth" => $request->dob,
            // "birth_certificate_no" => $request->birth_certificate_no,
            // "national_id_no" => $request->national_no,
            "religion_id" => $request->religion,
            "caste" => $request->caste,
           "email" => $request->email,
            "phone" => $request->phone,
            "current_address" => $request->address,
            "permanent_address" => $request->permanent_address,
            "bloodgroup_id" => $request->blood,
            "student_category_id" => $request->category,
            "height" => $request->height,
            "weight" => $request->weight,
            "status" => $request->status,
        ]);

        // $ParentDetail = ParentDetail::where(['id'=>$request->parent_id])->update([
        //     "father_img" => $f_image,
        //     "father_name" => $request->f_name,
        //     "f_occupation" => $request->f_occupation,
        //     "father_phoneNumber" => $request->f_phone,
    
        //     "mother_img" => $m_image,
        //     "mother_name" => $request->m_name,
        //     "m_occupation" => $request->m_occupation,
        //     "mother_phoneNumber" => $request->m_phone,
    
        //     "guardian_relation" => $request->gender,
        //     "guardian_name" => $request->guardian_name,
        //     "guardian_email" => $request->guardian_email,
        
        //     "guardian_img" =>  $image,
        //     "guardian_phone" => $request->guardian_phone,
        //     "guardian_occupation" => $request->guardian_occupation,
        //     "guardian_address" => $request->guardian_address,
        // ]);
      

        $documentInfo = DocumentInfo::where('std_id',$id)->update(['std_id'=>$id],[
            "national_id_no" =>$request->national_no,
            "national_doc" => $national_doc,
            "birth_certificate_no" => $request->birth_certificate_no,
            "birth_doc" => $birth_doc,
        
        ]);

        $bankInfo = BankInfo::where('std_id',$id)->update(['std_id'=>$id],[
           "bank_name" => $request->bank,
            "bank_account_number" => $request->account_no,
            "ifsc_code" => $request->code,
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

    public function yb_getSibling_parentInfo(Request $request){
        $parent_type = $request->parent_type;
        $sibling = $request->sibling;
        if($parent_type == 'sibling'){
            $parent = ParentDetail::select('father_name','mother_name','guardian_name')->where('id',$sibling)->first();
            return view('admin.student.parent-info',compact('parent'));
        }else{
            $staff = Staff::select('staffs.designation','staffs.f_name','staffs.l_name')->with('designation_name')->where('id',$sibling)->first();
            return view('admin.student.parent-info',compact('staff'));
        }
    }

    public function yb_promote_students(Request $request){
        $academic_year = AcademicYear::all();
        $classes = StdClass::all();
        if($request->input()){
            // return $request->input();

            $students = Student::select('id','admission_no','first_name','last_name')->where(['academic_id'=>$request->from_year,'class_id'=>$request->class,'section_id'=>$request->section])->get();

            $class_sections = StdClass::where('id',$request->class)->pluck('section')->first();
            $section_arr = array_filter(explode(',',$class_sections));
            $sections = Section::whereIn('id',$section_arr)->get();

            return view('admin.student-promote.promote-table',['from_year'=>$request->from_year,'to_year'=>$request->to_year,'from_class'=>$request->class,'from_section'=>$request->section,'students'=>$students,'sections'=>$sections,'classes'=>$classes]);
        }else{
            
            return view('admin.student-promote.index',compact('academic_year','classes'));
        }
    }

    public function yb_submit_promote_students(Request $request){
        // return $request->input();
        $student_count = count($request->students);
        for($i=0;$i<$student_count;$i++){
            DB::table('student_promotion')->insert([
                'student_id' => $request->students[$i],
                'from_year' => $request->from_year,
                'to_year' => $request->to_year,
                'from_class' => $request->from_class,
                'to_class' => $request->promote_class[$i],
                'from_section' => $request->from_section,
                'to_section' => $request->promote_section[$i],
                'roll_no' => $request->roll_no[$i],
            ]);

            $student = Student::find($request->students[$i]);
            $student->academic_id = $request->to_year;
            $student->class_id = $request->promote_class[$i];
            $student->section_id = $request->promote_section[$i];
            if($request->roll_no[$i] != null){
                $student->roll_no = $request->roll_no[$i];
            }
            $save = $student->save();
        }
        return '1';
    }
}
