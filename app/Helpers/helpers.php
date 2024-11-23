<?php

use App\Models\ParentDetail;
use App\Models\StdClass;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


if(! function_exists('yb_get_class_section')){

    function yb_get_class_section($class,$assigned_sections = null){
      //  return $class;
        if($assigned_sections != null){
            $stdClass = $assigned_sections;
        }else{
            $stdClass = StdClass::where('id',[$class])->pluck('section')->first();
        }
        $section = explode(',',$stdClass);
        $section = Section::whereIn('id', $section)->get();
        $output = '<option disabled selected value="">Select Section Name</option>';
        if(!empty($section)){
            foreach($section as $row){
                $output .= '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
        }else{
            $output = '<option disabled selected value=">No Section Found</option>';
        }
        return $output;
    }
}

if(! function_exists('yb_get_section_students')){
    function yb_get_section_students($class,$section){
        $students = Student::select('id','first_name','last_name','parent_id')->where(['class_id'=>$class,'section_id'=>$section])->get();
        return view('admin.student.section-students',compact('students'));
        // return $students;
    }
}


if(! function_exists('yb_upload_img')){
    function yb_upload_img($image,$dir){
        if($image){
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($dir),$name);
        }else{
            $name = null;
        }
        return $name;
    }
}

if(! function_exists('yb_remove_img')){
    function yb_remove_img($image,$dir){
        $path = public_path($dir).'/'.$image;
        if(file_exists($path)){
                unlink($path);
            }
       
    }
}


if(! function_exists('yb_get_parent_child')){
    function yb_get_parent_child($id){
       return Student::select('id','first_name','last_name')->where('parent_id',$id)->get();
    }
}