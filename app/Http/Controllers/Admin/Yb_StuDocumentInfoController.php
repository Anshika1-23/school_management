<?php

namespace App\Http\Controllers\Admin;
use App\Models\DocumentAttachment;
use App\Http\Requests\StuDocumentInfoRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_StuDocumentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = DocumentAttachment::latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="document-info/'.$row->id.'/edit" class="btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-document btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.document-info.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.document-info.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StuDocumentInfoRequest $request)
    {
        //

        if($request->img){
            $image = $request->img->getClientOriginalName();
            $request->img->move(public_path('document-info'),$image);
        }else {
            $image = "";
        }

        $documentAttachment = new DocumentAttachment();
        $documentAttachment->document_file = $image;
        $documentAttachment->document_title = $request->title;
        $result = $documentAttachment->save();
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
        $documentAttachment = DocumentAttachment::where(['id'=>$id])->first();
        return $documentAttachment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StuDocumentInfoRequest $request, string $id)
    {
        //
         // Update Student Document Info Image
         if($request->img != ''){        
            $path = public_path().'/document-info/';
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

        $documentAttachment = DocumentAttachment::where(['id'=>$id])->update([
            "img" => $image,
            "document_title" =>$request->title,
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = DocumentAttachment::where('id',$id)->delete();
        return  $destroy;
    }
}
