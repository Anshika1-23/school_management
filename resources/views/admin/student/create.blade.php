@extends('admin.layout')
@section('title','Add New Student')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Student'=>'admin/students']])
            @slot('title') Add Student @endslot
            @slot('add_btn') <a href="{{url('admin/students/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Student  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <form id="addStudent" method="POST" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">ACADEMIC INFORMATION</h4>
                                <span><button type="submit" class="btn btn-primary"> Submit </button></span>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Academic Year </label>
                                                    <select class="form-select" name="academic_year" >
                                                        <option value="" selected disabled>Select Academic Year</option>
                                                        @if(!empty($academic))
                                                            @foreach($academic as $types)
                                                                <option value="{{$types->id}}" selected>{{$types->year}}</option>
                                                            @endforeach
                                                        @endif    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Class </label>
                                                    <select class="form-select class-select" name="stdClass">
                                                        <option value="" selected disabled>Select Student Class</option>
                                                        @if(!empty($class))
                                                            @foreach($class as $types)
                                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                            @endforeach
                                                        @endif    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Section </label>
                                                    <select class="form-select section-select" name="section">
                                                        <option value="" selected disabled>Select Section</option>
                                                            
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Admission Number </label>
                                                    <input type="number" class="form-control" placeholder="Admission Number" name="admission_no" value="{{$admission}}" data-parsley-required="true"/> 
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label"> Admission Date </label>
                                                    <input type="date" class="form-control" placeholder="Admission Date" name="admission_date" value="{{date('Y-m-d')}}"/> 
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label"> Roll Number </label>
                                                    <input type="number" class="form-control" placeholder="Roll Number" name="roll_no"/> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">PERSONAL INFO</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group mandatory">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="std_name" placeholder="First Name"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Last Name </label>
                                                <input type="text" class="form-control" name="l_name" placeholder="Last Name"/> 
                                            </div>
                                        </div>
                                      
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="form-label">Date OF Birth</label>
                                                <input type="date" class="form-control" name="dob" placeholder="Date OF Birth"/> 
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="form-label"> Religion </label>
                                                <select class="form-select" name="religion">
                                                    <option value="" selected disabled>Select Religion</option>
                                                    @if(!empty($religion))
                                                        @foreach($religion as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="form-label">Caste</label>
                                                <input type="text" class="form-control" name="caste" placeholder="Caste"/> 
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select" name="gender">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                    <option value="2">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="mb-3">
                                                <label for="studentImg" class="form-label">Student Image</label>
                                                <input class="form-control" type="file" id="studentImg" name="std_img" onChange="readURL(this);">
                                            </div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <img id="image" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="85px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Parents Info</h4>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#parents-modal" class="btn btn-primary btn-sm">+ Add Parents</button>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <input type="text" name="old_parent_id" hidden value="">
                                    <input type="text" name="student_parent_type" hidden value="">
                                    <div class="old-parent-info">
                                    </div>
                                    <div class="form-body parent-body">
                                        <div class="row mb-5 pb-5 border-bottom">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label"> Father Name </label>
                                                    <input type="text" class="form-control" placeholder="Father Name" name="f_name"/> 
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Father Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Father Occupation " name="f_occupation"/> 
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Father Phone</label>
                                                    <input type="number" class="form-control" placeholder="Father Phone Number" name="f_phone"/> 
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                    <label class="form-label">Father Image</label>
                                                    <input class="form-control" type="file" name="father_img" onChange="readURL_1(this);">
                                            </div>
                                            <div class="col-1 align-content-center">
                                                <img id="image1" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="100%">
                                            </div>
                                        </div>
                                        <div class="row border-bottom pb-5 mb-5">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label"> Mother Name </label>
                                                    <input type="text" class="form-control" placeholder="Mother Name" name="m_name"/> 
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Mother Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Mother Occupation" name="m_occupation"/> 
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Mother Phone</label>
                                                    <input type="number" class="form-control" placeholder="Mother Phone Number" name="m_phone"/> 
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                    <label for="motherImg" class="form-label">Mother Image</label>
                                                    <input class="form-control" type="file" id="motherImg" name="mother_img" onChange="readURL_2(this);">
                                            </div>
                                            <div class="col-1 align-content-center">
                                                <img id="image2" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="100%">
                                            </div>   
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Relation With Guardian</label>
                                                    <ul class="list-unstyled d-flex">
                                                    <li class="form-check me-4">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="form-check-input form-check-success" name="guardian_relation"  value="1" id="radio" >
                                                            <label class="form-check-label" for="radio">Father</label>
                                                        </div>
                                                    </li>
                                                    <li class="form-check me-4">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="form-check-input form-check-success" name="guardian_relation"  value="0" id="radio1" >
                                                            <label class="form-check-label" for="radio1">Mother</label>
                                                        </div>
                                                    </li>
                                                    <li class="form-check me-4">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="form-check-input form-check-success" name="guardian_relation" value="-1" checked id="radio2" >
                                                            <label class="form-check-label" for="radio2">Others</label>
                                                        </div>
                                                    </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label"> Guardian Name </label>
                                                    <input type="text" class="form-control" placeholder="Guardians Name" name="guardian_name"/> 
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Guardian Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Guardian Occupation" name="guardian_occupation"/> 
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Guardian Phone</label>
                                                    <input type="number" class="form-control" placeholder="Guardian Phone Number" name="guardian_phone"/> 
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
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" placeholder="Guardian Password" name="guardian_password" data-parsley-required="true"/> 
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Guardian Address</label>
                                                    <textarea name="guardian_address" class="form-control" placeholder="Guardian Address"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label for="gurimg" class="form-label">Guardian Image</label>
                                                    <input class="form-control" type="file" id="gurImg" name="img" onChange="readURL_3(this);">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img id="image3" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="85px">
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Document Information</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Birth Certificate Number</label>
                                                    <input type="text" class="form-control" name="birth_certificate_no" placeholder="Birth Certificate Number"/> 
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Birth Document</label>
                                                    <input class="form-control" type="file" name="birth_doc" >
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">NATIONAL ID CARD</label>
                                                    <input type="text" class="form-control" name="national_no" placeholder="National Id Card"/> 
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label class="form-label">National Document</label>
                                                    <input class="form-control" type="file" name="national_doc">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">CONTACT INFORMATION</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group mandatory">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="number" class="form-control" name="phone" placeholder="Phone Number"/>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label">Current Address</label>
                                                    <textarea class="form-control" name="address" placeholder="Current Address" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label">Permanent Address</label>
                                                    <textarea class="form-control"  name="permanent_address" placeholder="Permanent Address" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">MEDICAL RECORD</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Blood Group</label>
                                                    <select class="form-select" name="blood">
                                                        <option value="" selected disabled>Blood Group</option>
                                                        @if(!empty($blood))
                                                            @foreach($blood as $types)
                                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                            @endforeach
                                                        @endif    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Student Category</label>
                                                    <select class="form-select" name="category">
                                                        <option value="" selected disabled>Select Category</option>
                                                        @if(!empty($category))
                                                            @foreach($category as $types)
                                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                            @endforeach
                                                        @endif    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Height(IN)</label>
                                                    <input type="text" class="form-control" name="height" placeholder="Height">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Weight(KG)</label>
                                                    <input type="text" class="form-control" name="weight" placeholder="Weight">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Bank Information</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" name="bank" placeholder="Bank Name"/> 
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label">Bank Account Number</label>
                                                    <input type="text" class="form-control" name="account_no" placeholder="Bank Account Number"/> 
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label">IFSC Code</label>
                                                    <input type="text" class="form-control" name="code" placeholder="IFSC Code"/> 
                                                </div>
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
        <div class="modal fade text-left" data-bs-backdrop="static" data-bs-keyboard="false" id="parents-modal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Select Sibling </h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled d-flex">
                            <li class="me-3">
                                <input type="radio" id="parent-type" name="parent_type" class="form-check-input form-check-success parent-type" checked value="sibling">
                                <label for="parent-type">From Sibling</label>
                            </li>
                            <li>
                                <input type="radio" id="parent-staff" name="parent_type" class="form-check-input form-check-success parent-type" value="staff">
                                <label for="parent-staff">From Staff</label>
                            </li>
                        </ul>
                        <div class="student-input">
                            <div class="form-group">
                                <label for="">Class</label>
                                <select name="sibling_class" class="form-control sibling-class">
                                    <option value="" selected disabled>Select Class</option>
                                    @if(!empty($class))
                                        @foreach($class as $types)
                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                        @endforeach
                                    @endif  
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Section</label>
                                <select name="sibling_section" class="form-control sibling-section">
                                    <option value="" selected disabled>Select Section</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Student</label>
                                <select name="sibling" class="form-control sibling">
                                    <option value="" selected disabled>Select Student</option>
                                </select>
                            </div>
                        </div>
                        <div class="staff-input d-none">
                            <div class="form-group">
                                <select name="sibling" class="form-control parent-staff">
                                    <option value="" selected disabled>Select Staff</option>
                                    @if(!empty($staff_list))
                                        @foreach($staff_list as $staff)
                                            <option value="{{$staff->id}}">{{$staff->f_name}} {{$staff->l_name}}</option>
                                        @endforeach
                                    @endif 
                                </select>
                            </div>
                        </div>
                        <div class="error text-danger"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save-sibling">
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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

            function readURL_3(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image3').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        </script>
        @stop
