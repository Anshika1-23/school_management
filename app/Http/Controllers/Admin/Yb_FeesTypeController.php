<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeesType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Requests\FeesTypeRequest;
use App\Models\FeesGroup;

class Yb_FeesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FeesType::with('group_name')->latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('group_title',function($row){
                return $row->group_name->title;
            })
            ->addColumn('action', function($row){
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editFeesType btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-fees-type" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        }
        $groups = FeesGroup::all();
        return view('admin.fees-type.index',compact('groups'));
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
    public function store(FeesTypeRequest $request)
    {
        $type = new FeesType();
        $type->title = $request->title;
        $type->group = $request->group;
        $type->descr = $request->descr;
        $result = $type->save();
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show(FeesType $feesType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeesType $feesType)
    {
        return $feesType;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeesTypeRequest $request, FeesType $feesType)
    {
        $type = FeesType::where(['id'=>$feesType->id])->update([
            "title"=>$request->title,
            "group"=>$request->group,
            "descr"=>$request->descr,
        ]);
        return $type;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeesType $feesType)
    {
        $destroy = FeesType::where('id',$feesType->id)->delete();
        return  $destroy;
    }
}
