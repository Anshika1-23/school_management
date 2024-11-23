@extends('staff.layout')
@section('title','Add New Document Info')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index','Document Info'=>'staff/doc-info']])
            @slot('title') Add Document Info @endslot
            @slot('add_btn') <a href="{{url('staff/document-info/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Document Info @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addDocument" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10 col-10">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Document Image</label>
                                                <input class="form-control" type="file" id="formFile" name="img" onChange="readURL(this);">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2">
                                            <img id="image" src="{{asset('public/document-info/default.png')}}" alt="No Image" width="100px">
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Title Name</label>
                                                <input type="text" class="form-control" placeholder="Document Info Name" name="title" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <button type="submit" class="btn btn-primary"> Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        </script>
        @stop
