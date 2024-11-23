<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Http\Requests\SessionRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Session::latest('id')->get();
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
                    $btn = '<a href="sessions/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-session btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.session.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.session.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionRequest $request)
    {
        //
        $session = new Session();
        $session->title = $request->title;
        $session->start_date= $request->start_date; 
        $session->end_date = $request->end_date;
        $result = $session->save();
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
        $session = Session::where('id',$id)->first();
        return view('admin.session.edit',['session'=>$session]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionRequest $request, string $id)
    {
        //
        $session = Session::where(['id'=>$id])->update([
            "title" => $request->title,
            "start_date"=> $request->start_date, 
            "end_date" => $request->end_date,
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
        $destroy = Session::where('id',$id)->delete();
        return  $destroy;
    }
}
