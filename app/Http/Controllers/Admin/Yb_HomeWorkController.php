<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Models\StdClass;
use App\Models\HomeWork;
use App\Models\Section;
use App\Models\Subject;
use App\Http\Requests\HomeWorkRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_HomeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = HomeWork::with('class_name:id,title','section_name:id,title','subject_name:id,title')->latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('class', function($row){
                return $row->class_name->title;
            })
            ->addColumn('section', function($row){
                return $row->section_name->title;
            })
            ->addColumn('subject', function($row){
                return $row->subject_name->title;
            })
            ->editColumn('homework_date',function($row){
                return date('d M, Y',strtotime($row->homework_date));
            })
            ->editColumn('submission_date',function($row){
                return date('d M, Y',strtotime($row->submission_date));
            })
            ->addColumn('action', function($row){
            $btn = '<a href="homework/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-homework" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.homework.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subject = Subject::all();
        $stdClass = StdClass::all();
        $section = Section::all();
        return view('admin.homework.create',['class'=>$stdClass,'section'=>$section,'subject'=>$subject]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HomeWorkRequest $request)
    {
        //
        // Add HomeWork Image
        $home_file = yb_upload_img($request->att_file,'homework');

        $homework = new Homework();
        $homework->class_id = $request->class_id;
        $homework->section_id = $request->section;
        $homework->subject_id = $request->subject;
        $homework->homework_date = $request->work_date;
        $homework->submission_date = $request->submission_date;
        $homework->marks = $request->mark;
        $homework->file = $home_file;
        $homework->description = $request->des;
        if(session()->get('admin') != ''){ 
            $homework->created_by = '0';
        }else{
            $homework->created_by = '1';
        }
        $save = $homework->save();
        return $save;
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
        $homeWork = HomeWork::where(['id'=>$id])->first();
        $class_info = StdClass::where('id',$homeWork->class_id)->first();
        $section_ids_arr = array_filter(explode(',',$class_info->section));
        $subject_ids_arr = array_filter(explode(',',$class_info->subjects));
        $section = Section::whereIn('id',$section_ids_arr)->get();
        $subject = Subject::whereIn('id',$subject_ids_arr)->get();
        $stdClass = StdClass::all();
        return view('admin.homework.edit',['homeWork'=>$homeWork,'class'=>$stdClass,'section'=>$section,'subject'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HomeWorkRequest $request, string $id)
    {
        //
        // Update HomeWork File
        if($request->att_file != ''){        
            $path = public_path().'/homework/';
            //code for remove old file
            if($request->old_att_file!= ''  && $request->old_att_file != null){
                yb_remove_img($request->old_att_file,'homework');
            }
            //upload new file
            $home_file = yb_upload_img($request->att_file,'homework');
        }else{
            $home_file = $request->old_att_file;
        }
    
        $homeWork = HomeWork::where(['id'=>$id])->update([
            "file" =>$home_file,
            "class_id" => $request->class_id,
            "section_id" => $request->section,
            "subject_id" => $request->subject, 
            "homework_date" => $request->work_date,
            "submission_date" => $request->submission_date,
            "marks" => $request->mark,
            "description" => $request->des,
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $imagePath = HomeWork::select('file')->where('id', $id)->first();
        $filePath = public_path().'/homework/'.$imagePath->image;
        File::delete($filePath);

        $destroy = HomeWork::where('id',$id)->delete();
        return  $destroy;
    }

    public function yb_get_class_subjects(Request $request){
        $class_id = $request->cls;
        $subject_ids = StdClass::where('id',$class_id)->pluck('subjects')->first();
        $subject_id_arr = array_filter(explode(',',$subject_ids));
        $subjects = Subject::whereIn('id',$subject_id_arr)->get();
        return view('admin.homework.subject-list',compact('subjects'));
    }
}
