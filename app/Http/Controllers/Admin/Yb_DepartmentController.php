<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Department::orderBy('id')->get();
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
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editDepartment btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-department" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.department.index');
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
    public function store(DepartmentRequest $request)
    {
        //
        $department = new Department();
        $department->title = $request->title;
        $result = $department->save();
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
        $department = Department::where(['id'=>$id])->first();
        return $department;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        //
        $department  = Department::where(['id'=>$id])->update([
            "title"=>$request->title,
            "status"=>$request->status,
        ]);
        return $department;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Department::where('id',$id)->delete();
        return  $destroy;
    }
}
