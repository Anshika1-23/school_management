@extends('admin.layout')
@section('title','Edit Parent')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Parent'=>'admin/parents']])
            @slot('title') Edit Parent @endslot
            @slot('add_btn')  @endslot
            @slot('active') Edit Parent  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <form id="editParent" method="POST" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                {{ method_field('PUT') }}
                @if($parent)
                    <input type="hidden" class="url" value="{{url('admin/parents/'.$parent->id)}}">
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
                                                        <input type="text" class="form-control" value="{{$parent->father_name}}"  placeholder="Father Name" name="f_name"/> 
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Father Occupation</label>
                                                        <input type="text" class="form-control" value="{{$parent->f_occupation}}" placeholder="Father Occupation Name " name="f_occupation"/> 
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Father Phone</label>
                                                        <input type="number" class="form-control" value="{{$parent->father_phoneNumber}}" placeholder="Father Phone Number" name="f_phone"/> 
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Father Image</label>
                                                        <input type="hidden" class="form-control" name="old_img" value="{{$parent->father_img}}" />
                                                        <input class="form-control" type="file" id="formFile" name="father_img" onChange="readURL(this);">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    @if($parent->father_img != '')
                                                        <img id="image" src="{{asset('public/father/'.$parent->father_img)}}" alt="" width="85px">
                                                    @else
                                                        <img id="image" src="{{asset('public/father/default.png')}}" alt="" width="85px">
                                                    @endif
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
                                                    <input type="text" class="form-control" value="{{$parent->mother_name}}" placeholder="Mother Name" name="m_name"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Mother Occupation</label>
                                                    <input type="text" class="form-control" value="{{$parent->m_occupation}}" placeholder="Mother Occupation Name " name="m_occupation"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Mother Phone</label>
                                                    <input type="number" class="form-control" value="{{$parent->mother_phoneNumber}}" placeholder="Mother Phone Number" name="m_phone"/> 
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Mother Image</label>
                                                    <input type="hidden" class="form-control" name="old_img" value="{{$parent->mother_img}}" />
                                                    <input class="form-control" type="file" id="formFile" name="mother_img" onChange="readURL_1(this);">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                @if($parent->mother_img != '')
                                                    <img id="image1" src="{{asset('public/mother/'.$parent->mother_img)}}" alt="" width="85px">
                                                @else
                                                    <img id="image1" src="{{asset('public/mother/default.png')}}" alt="" width="85px">
                                                @endif
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
                                                            <input type="radio" class="form-check-input form-check-success" name="gender" id="radio" value="1" {{$parent->guardian_relation == "1" ? "checked":""}}>
                                                            <label class="form-check-label" for="radio">Male</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="form-check-input form-check-success" name="gender" id="radio1" value="0" {{$parent->guardian_relation == "0" ? "checked":""}}>
                                                            <label class="form-check-label" for="radio1">Female</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="form-check-input form-check-success" name="gender" id="radio2" value="-1" {{$parent->guardian_relation == "-1" ? "checked":""}}>
                                                            <label class="form-check-label" for="radio2">Other</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Guardian Name </label>
                                                    <input type="text" class="form-control" value="{{$parent->guardian_name}}" placeholder="Guardians Name" name="guardian_name"  data-parsley-required="true"/> 
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group mandatory">
                                                    <label class="form-label">Guardian Email</label>
                                                    <input type="text" class="form-control" value="{{$parent->guardian_email}}" placeholder="Guardian Email" name="guardian_email" data-parsley-required="true"/> 
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Guardian Occupation</label>
                                                    <input type="text" class="form-control" value="{{$parent->guardian_occupation}}" placeholder="Guardian Occupation Name " name="guardian_occupation"/> 
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Guardian Phone</label>
                                                    <input type="number" class="form-control" value="{{$parent->guardian_phone}}" placeholder="Guardian Phone Number" name="guardian_phone"/> 
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Guardian Address</label>
                                                    <input type="text" class="form-control" value="{{$parent->guardian_address}}" placeholder="Guardian Address" name="guardian_address"/> 
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Guardian Image</label>
                                                    <input type="hidden" class="form-control" name="old_img" value="{{$parent->guardian_img}}" />
                                                    <input class="form-control" type="file" id="formFile" name="img" onChange="readURL_2(this);">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                @if($parent->guardian_img != '')
                                                    <img id="image2" src="{{asset('public/guardian/'.$parent->guardian_img)}}" alt="" width="85px">
                                                @else
                                                    <img id="image2" src="{{asset('public/guardian/default.png')}}" alt="" width="85px">
                                                @endif
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                @endif
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

