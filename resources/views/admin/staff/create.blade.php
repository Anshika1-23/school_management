@extends('admin.layout')
@section('title','Add New Staff')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Staff'=>'admin/staffs']])
            @slot('title') Add Staff @endslot
            @slot('add_btn') <a href="{{url('admin/staffs/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Staff  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <form id="addStaff" method="POST" enctype="multipart/form-data" data-parsley-validate>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Role </label>
                                                <select class="form-select" name="role" id="basicSelect">
                                                    <option value="" selected disabled>Select Role</option>
                                                    @if(!empty($role))
                                                        @foreach($role as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Department </label>
                                                <select class="form-select" name="department" id="basicSelect">
                                                    <option value="" selected disabled>Select Department</option>    
                                                    @if(!empty($department))
                                                        @foreach($department as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Designation </label>
                                                <select class="form-select" name="designation" id="basicSelect">
                                                    <option value="" selected disabled>Select Designation</option>    
                                                    @if(!empty($designation))
                                                        @foreach($designation as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> First Name </label>
                                                <input type="text" class="form-control" placeholder="First Name" name="f_name" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Last Name </label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="l_name"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Date Of Birth</label>
                                                <input type="date" class="form-control" placeholder="Date Of Birth" name="dob"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Email </label>
                                                <input type="text" class="form-control" placeholder="Email" name="email" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Mobile</label>
                                                <input type="number" class="form-control" placeholder="Mobile" name="mobile"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Emergency Mobile</label>
                                                <input type="number" class="form-control" placeholder="Emergency Mobile" name="emg_mobile"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Marital Status</label>
                                                <select class="form-select" name="m_status" id="basicSelect">
                                                    <option value="" selected disabled>Select Status</option>    
                                                    <option value="1">Married</option>
                                                    <option value="0">UnMarried</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select" name="gender" id="basicSelect">
                                                    <option value="" selected disabled>Select Gender</option>    
                                                    <option value="1">Male</option>
                                                    <option value="0">Female</option>
                                                    <option value="-1">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Date Of Joining</label>
                                                <input type="date" class="form-control" value="{{date('Y-m-d')}}" placeholder="Date Of Joining" name="doj"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Driving License No</label>
                                                <input type="text" class="form-control" name="driving_license"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-10">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Staff Photo</label>
                                                <input class="form-control" type="file" id="formFile" name="img" onChange="readURL(this);">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 text-end">
                                            <img id="image" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="100px">
                                        </div>
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Father Name </label>
                                                <input type="text" class="form-control" placeholder="Father Name" name="father_name"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Mother Name </label>
                                                <input type="text" class="form-control" placeholder="Mother Name" name="mother_name"/> 
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Permanent Address</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="permanent_address" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Qualifications</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="qualification" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Experience</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="experience" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Payroll Details</h5>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Basic Salary</label>
                                    <input type="number" class="form-control" name="salary" />
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Contract Type</label>
                                    <select name="contract" class="form-select">
                                        <option value="" disabled selected>Contract Type</option>
                                        <option value="1">Permanent</option>
                                        <option value="0">Contract</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Bank Details</h5>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label">Bank Account Name</label>
                                    <input type="text" class="form-control" name="account_name" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label">Account No</label>
                                    <input type="number" class="form-control" name="account_num" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label">Bank Ifsc</label>
                                    <input type="text" class="form-control" name="branch_ifsc" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Document Details</h5>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Resume (Pdf only)</label>
                                    <input type="file" class="form-control" name="resume" />
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Joining Letter (Pdf only)</label>
                                    <input type="file" class="form-control" name="join_letter" />
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Other Document (Pdf only)</label>
                                    <input type="file" class="form-control" name="other_doc" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                    </form>
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
