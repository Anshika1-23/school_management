<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_NoticeController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Notice::orderBy('id')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('notice_date',function($row){
                return date('d M, Y',strtotime($row->notice_date));
            })
            ->addColumn('action', function($row){
            $btn = '<a href="notice-list/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-notice" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.notice-list.index');
    }

    public function create(){
        $roles = Role::all();
        return view('admin.notice-list.create',compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|unique:notices,title',
            'notice' => 'required',
            'date' => 'required',
            'message_to' => 'required',
        ]);

        $notice = new Notice();
        $notice->title = $request->title;
        $notice->description = $request->notice;
        $notice->notice_date = $request->date;
        $notice->message_to = $request->message_to;
        $save = $notice->save();
        return $save;
    }

    public function edit($id){
        $notice = Notice::find($id);
        $roles = Role::all();
        return view('admin.notice-list.edit',compact('notice','roles'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|unique:notices,title,'.$id.',id',
            'notice' => 'required',
            'date' => 'required',
            'message_to' => 'required',
        ]);
        $notice = Notice::find($id);
        $notice->title = $request->title;
        $notice->description = $request->notice;
        $notice->notice_date = $request->date;
        $notice->message_to = $request->message_to;
        $update = $notice->save();
        return $update;
        
    }

    public function destroy($id){
        $destroy = Notice::where('id',$id)->delete();
        return  $destroy;
    }
}
