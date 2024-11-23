<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Yajra\DataTables\DataTables;

class Yb_HolidayController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Holiday::orderBy('id')->latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('from_date',function($row){
                return date('d M, Y',strtotime($row->from_date));
            })
            ->editColumn('to_date',function($row){
                return date('d M, Y',strtotime($row->to_date));
            })
            ->addColumn('action', function($row){
            $btn = '<a href="holiday/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-holiday" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.holiday.index');
    }

    public function create(){
        return view('admin.holiday.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|unique:holidays,title',
            'details' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $holiday = new Holiday();
        $holiday->title = $request->title;
        $holiday->details = $request->details;
        $holiday->from_date = $request->from_date;
        $holiday->to_date = $request->to_date;
        $save = $holiday->save();
        return $save;
    }

    public function edit($id){
        $holiday = Holiday::find($id);
        return view('admin.holiday.edit',compact('holiday'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|unique:holidays,title,'.$id.',id',
            'details' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $holiday = Holiday::find($id);
        $holiday->title = $request->title;
        $holiday->details = $request->details;
        $holiday->from_date = $request->from_date;
        $holiday->to_date = $request->to_date;
        $update = $holiday->save();
        return $update;
        
    }

    public function destroy($id){
        $destroy = Holiday::where('id',$id)->delete();
        return  $destroy;
    }
}
