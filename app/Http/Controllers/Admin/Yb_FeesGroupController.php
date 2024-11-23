<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeesGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\FeesGroupRequest;

class Yb_FeesGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FeesGroup::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editFeesGroup btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-fees-group" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        }
        return view('admin.fees-group.index');
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
    public function store(FeesGroupRequest $request)
    {
        $group = new FeesGroup();
        $group->title = $request->title;
        $group->descr = $request->descr;
        $result = $group->save();
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show(FeesGroup $feesGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeesGroup $feesGroup)
    {
        return $feesGroup;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeesGroupRequest $request, FeesGroup $feesGroup)
    {
        $group = FeesGroup::where(['id'=>$feesGroup->id])->update([
            "title"=>$request->title,
            "descr"=>$request->descr,
        ]);
        return $group;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeesGroup $feesGroup)
    {
        $destroy = FeesGroup::where('id',$feesGroup->id)->delete();
        return  $destroy;
    }
}
