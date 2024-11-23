<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Yb_SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Subject::latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('title_type', function($row){
                    if($row->title_type == '1'){
                        $title_type = '<label class="badge bg-light-warning">Practical</label>';
                    }else{
                        $title_type = '<label class="badge bg-light-secondary">Theory</label>';
                    }
                    return $title_type;
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
                    $btn = '<a href="subjects/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-subject btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['title_type','status','action'])
                ->make(true);
        }
        return view('admin.subject.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        //
        $subject = new Subject();
        $subject->title = $request->title;
        if($request->input('title_type')) {
            $value = true;
        } else {
            $value = false;
        }
        $subject->title_type = $value ? 1 : 0;
        $result = $subject->save();
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
        $subject = Subject::where('id',$id)->first();
        return view('admin.subject.edit',['subject'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, string $id)
    {
        //
        $subject = Subject::where(['id'=>$id])->update([
            "title" => $request->title,
            "title_type" => $request->input('title_type', false),
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
        $destroy = Subject::where('id',$id)->delete();
        return  $destroy;
    }
}
