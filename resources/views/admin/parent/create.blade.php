@extends('admin.layout')
@section('title','Add New Parent')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Parent'=>'admin/parents']])
            @slot('title') Add Parent @endslot
            @slot('add_btn') <a href="{{url('admin/parents/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Student  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <form id="addParent" method="POST" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">FATHERS INFO</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label"> Father Name </label>
                                                    <input type="text" class="form-control" placeholder="Father Name" name="f_name"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Father Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Father Occupation Name " name="f_occupation"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Father Phone</label>
                                                    <input type="number" class="form-control" placeholder="Father Phone Number" name="f_phone"/> 
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Father Image</label>
                                                    <input class="form-control" type="file" id="formFile" name="father_img" onChange="readURL(this);">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <img id="image" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="85px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">MOTHER INFO</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label"> Mother Name </label>
                                                    <input type="text" class="form-control" placeholder="Mother Name" name="m_name"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Mother Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Mother Occupation Name " name="m_occupation"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Mother Phone</label>
                                                    <input type="number" class="form-control" placeholder="Mother Phone Number" name="m_phone"/> 
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Mother Image</label>
                                                    <input class="form-control" type="file" id="formFile" name="mother_img" onChange="readURL_1(this);">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <img id="image1" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="85px">
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">GUARDIAN INFO</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Gender</label>
                                                <div class="form-check">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="form-check-input form-check-success" name="gender"  value="1" id="radio" >
                                                        <label class="form-check-label" for="radio">Male</label>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="form-check-input form-check-success" name="gender"  value="0" id="radio1" >
                                                        <label class="form-check-label" for="radio1">Female</label>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="form-check-input form-check-success" name="gender" value="-1" id="radio2" >
                                                        <label class="form-check-label" for="radio2">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Guardian Name </label>
                                                <input type="text" class="form-control" placeholder="Guardians Name" name="guardian_name"  data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Guardian Email</label>
                                                <input type="text" class="form-control" placeholder="Guardian Email" name="guardian_email" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Guardian Password</label>
                                                <input type="password" class="form-control" placeholder="Guardian Password" name="guardian_password" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Guardian Occupation</label>
                                                <input type="text" class="form-control" placeholder="Guardian Occupation Name " name="guardian_occupation"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Guardian Phone</label>
                                                <input type="number" class="form-control" placeholder="Guardian Phone Number" name="guardian_phone"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Guardian Address</label>
                                                <input type="text" class="form-control" placeholder="Guardian Address" name="guardian_address"/> 
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Guardian Image</label>
                                                <input class="form-control" type="file" id="formFile" name="img" onChange="readURL_2(this);">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <img id="image2" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="85px">
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <div class="col-md-12 col-12">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </div>
            </form>
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

            function readURL_1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image1').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readURL_2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image2').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        </script>
@stop
