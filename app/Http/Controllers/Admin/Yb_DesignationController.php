<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Http\Requests\DesignationRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Designation::orderBy('id')->get();
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
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editDesignation btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-designation" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.designation.index');

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
    public function store(DesignationRequest $request)
    {
        //
        $designation = new Designation();
        $designation->title = $request->title;
        $result = $designation->save();
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
        $designation = Designation::where(['id'=>$id])->first();
        return $designation;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesignationRequest $request, string $id)
    {
        //
        $designation = Designation::where(['id'=>$id])->update([
            "title"=>$request->title,
            "status"=>$request->status,
        ]);
        return $designation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Designation::where('id',$id)->delete();
        return  $destroy;
    }
}
