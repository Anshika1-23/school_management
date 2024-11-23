<?php

namespace App\Http\Controllers\Admin;
use App\Models\ParentDetail;
use App\Models\StdClass;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ParentDetailRequest;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Yb_ParentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = ParentDetail::latest('id')->get();
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
                        $btn = '<a href="parents/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-parent btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
        }
        return view('admin.parent.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.parent.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParentDetailRequest $request)
    {
        //
        // Add Father Image
        if($request->father_img){
            $f_image = $request->father_img->getClientOriginalName();
            $request->father_img->move(public_path('father'),$f_image);
        }else {
            $f_image = "";
        }

        // Add Mother Image
        if($request->mother_img){
            $m_image = $request->mother_img->getClientOriginalName();
            $request->mother_img->move(public_path('mother'),$m_image);
        }else {
            $m_image = "";
        }
        
        // Add Guardian Image
        if($request->img){
            $image = $request->img->getClientOriginalName();
            $request->img->move(public_path('guardian'),$image);
        }else {
            $image = "";
        }

        $parentDetail = new ParentDetail();
        $parentDetail->father_img = $f_image;
        $parentDetail->father_name = $request->f_name;
        $parentDetail->f_occupation = $request->f_occupation;
        $parentDetail->father_phoneNumber = $request->f_phone;

        $parentDetail->mother_img = $m_image;
        $parentDetail->mother_name = $request->m_name;
        $parentDetail->m_occupation = $request->m_occupation;
        $parentDetail->mother_phoneNumber = $request->m_phone;

        $parentDetail->guardian_relation = $request->gender;
        $parentDetail->guardian_name = $request->guardian_name;
        $parentDetail->guardian_email = $request->guardian_email;
        $parentDetail->guardian_password = Hash::make($request->guardian_password);
        $parentDetail->guardian_img =  $image;
        $parentDetail->guardian_phone = $request->guardian_phone;
        $parentDetail->guardian_occupation = $request->guardian_occupation;
        $parentDetail->guardian_address = $request->guardian_address;
        $result = $parentDetail->save();
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
        $parentDetail = ParentDetail::where(['id'=>$id])->first();
        return view('admin.parent.edit',['parent'=>$parentDetail]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParentDetailRequest $request, string $id)
    {
        //
        // Update Father Image
        if($request->father_img != ''){        
            $path = public_path().'/father/';
            //code for remove old file
            if($request->old_img != ''  && $request->old_img != null){
                $file_old = $path.$request->old_img;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->father_img;
            $f_image = $request->father_img->getClientOriginalName();
            $file->move($path, $f_image);
        }else{
            $f_image = $request->old_img;
        }

        // Update Mother Image
        if($request->mother_img != ''){        
            $path = public_path().'/mother/';
            //code for remove old file
            if($request->old_img != ''  && $request->old_img != null){
                $file_old = $path.$request->old_img;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->mother_img;
            $m_image = $request->mother_img->getClientOriginalName();
            $file->move($path, $m_image);
        }else{
            $m_image = $request->old_img;
        }

        // Update Guardian Image
        if($request->img != ''){        
            $path = public_path().'/guardian/';
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

        $parentDetail = ParentDetail::where(['id'=>$id])->update([
            "father_img" => $f_image,
            "father_name" => $request->f_name,
            "f_occupation" => $request->f_occupation,
            "father_phoneNumber" => $request->f_phone,
    
            "mother_img" => $m_image,
            "mother_name" => $request->m_name,
            "m_occupation" => $request->m_occupation,
            "mother_phoneNumber" => $request->m_phone,
    
            "guardian_relation" => $request->gender,
            "guardian_name" => $request->guardian_name,
            "guardian_email" => $request->guardian_email,
         // "guardian_password" => Hash::make($request->guardian_password),
            "guardian_img" =>  $image,
            "guardian_phone" => $request->guardian_phone,
            "guardian_occupation" => $request->guardian_occupation,
            "guardian_address" => $request->guardian_address,
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = ParentDetail::where('id',$id)->delete();
        return  $destroy;
    }

    public function yb_GuardianReport(Request $request){
        $stdClass = StdClass::all();
    
            if ($request->ajax()) {
                $data = Student::with('parent_name')->where(['class_id'=>$request->input('class'),'section_id'=>$request->input('section')])->get();
                    return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('full_name', function($row){
                        return $row->full_name;
                    })
                    ->addColumn('class', function($row){
                        return $row->class_name->title .'(' . $row->section_name->title .')';
                    })
                  
                    ->addColumn('parent', function($row){
                        return $row->parent_name->guardian_name;
                    })
                    ->addColumn('parent_phone', function($row){
                        return $row->parent_name->guardian_phone;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="editGuaridanReport btn btn-primary btn-sm""><i class="bi bi-eye"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }else{
            return view('admin.reports.guardian-report',['class'=>$stdClass]);
        }
    }

    public function yb_getSingle_guardianDetail($id){
      $guardian = Student::with('class_name','parent_name')->where(['id'=>$id])->first();
        return view('admin.reports.guardian-info',['guardian'=>$guardian]);
       // return $guardian;
       
    }
}
