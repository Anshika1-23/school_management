@extends('admin.layout')
@section('title','Edit Staff')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Staff'=>'admin/staffs']])
            @slot('title') Edit Staff @endslot
            @slot('add_btn') @endslot
            @slot('active') Edit Staff  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <form id="updateStaff" method="POST" enctype="multipart/form-data" data-parsley-validate>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <input type="text" class="id" hidden value="{{$staff->id}}"/>
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Role </label>
                                                <select class="form-select" name="role" id="basicSelect">
                                                    <option value="" disabled>Select Role</option>
                                                    @if(!empty($role))
                                                        @foreach($role as $types)
                                                            <option value="{{$types->id}}" @if($types->id == $staff->role) selected @endif>{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Department </label>
                                                <select class="form-select" name="department" id="basicSelect">
                                                    <option value="" @if($staff->department == '') selected @endif disabled>Select Department</option>    
                                                    @if(!empty($department))
                                                        @foreach($department as $types)
                                                            <option value="{{$types->id}}" @if($types->id == $staff->department) selected @endif>{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Designation </label>
                                                <select class="form-select" name="designation" id="basicSelect">
                                                    <option value="" @if($staff->designation == '') selected @endif disabled>Select Designation</option>    
                                                    @if(!empty($designation))
                                                        @foreach($designation as $types)
                                                            <option value="{{$types->id}}" @if($types->id == $staff->designation) selected @endif>{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> First Name </label>
                                                <input type="text" class="form-control" placeholder="First Name" name="f_name" value="{{$staff->f_name}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Last Name </label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="l_name" value="{{$staff->l_name}}"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Date Of Birth</label>
                                                <input type="date" class="form-control" value="{{$staff->dob}}" placeholder="Date Of Birth" name="dob"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Email </label>
                                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{$staff->email}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Mobile</label>
                                                <input type="number" class="form-control" placeholder="Mobile" name="mobile" value="{{$staff->mobile}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Emergency Mobile</label>
                                                <input type="number" class="form-control" placeholder="Emergency Mobile" value="{{$staff->emergency_mobile}}" name="emg_mobile"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Marital Status</label>
                                                <select class="form-select" name="m_status" id="basicSelect">
                                                    <option value="" @if($staff->martial_status == '') selected @endif disabled>Select Status</option>    
                                                    <option value="1" @if($staff->martial_status == '1') selected @endif >Married</option>
                                                    <option value="0" @if($staff->martial_status == '0') selected @endif >UnMarried</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select" name="gender" id="basicSelect">
                                                    <option value="" @if($staff->gender == '') selected @endif disabled>Select Gender</option>    
                                                    <option value="1" @if($staff->gender == '1') selected @endif>Male</option>
                                                    <option value="0" @if($staff->gender == '0') selected @endif>Female</option>
                                                    <option value="-1" @if($staff->gender == '-1') selected @endif>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Date Of Joining</label>
                                                <input type="date" class="form-control" value="{{$staff->date_of_joining}}" placeholder="Date Of Joining" name="doj"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Driving License No</label>
                                                <input type="text" class="form-control" name="driving_lic" value="{{$staff->driving_license}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-10">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Staff Photo</label>
                                                <input class="form-control" type="file" id="formFile" name="img" onChange="readURL(this);">
                                                <input type="text" hidden name="old_staff_img" value="{{$staff->img}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 text-end">
                                            @if($staff->img != '')
                                            <img id="image" src="{{asset('public/staff/'.$staff->img)}}" alt="Face 1" width="100px">
                                            @else
                                            <img id="image" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="100px">
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Father Name </label>
                                                <input type="text" class="form-control" placeholder="Father Name" name="father_name" value="{{$staff->father_name}}"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Mother Name </label>
                                                <input type="text" class="form-control" placeholder="Mother Name" name="mother_name" value="{{$staff->mother_name}}"/> 
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3">{{$staff->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Permanent Address</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="permanent_address" rows="3">{{$staff->permanent_address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Qualifications</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="qualification" rows="3">{{$staff->qualification}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Experience</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="experience" rows="3">{{$staff->experience}}</textarea>
                                            </div>
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
                                    <input type="number" class="form-control" name="salary" value="{{$staff->salary}}" />
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Contract Type</label>
                                    <select name="contract" class="form-select">
                                        <option value="" disabled @if($staff->contract == '') selected @endif>Contract Type</option>
                                        <option value="1" @if($staff->contract == '1') selected @endif>Permanent</option>
                                        <option value="0" @if($staff->contract == '0') selected @endif>Contract</option>
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
                                    <input type="text" class="form-control" name="account_name" value="{{$staff->bank_info->account_name}}" />
                                    <input type="text" hidden name="bank_id" value="{{$staff->bank_info->id}}">
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label">Account No</label>
                                    <input type="number" class="form-control" name="account_num" value="{{$staff->bank_info->account_num}}" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" value="{{$staff->bank_info->bank_name}}" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label">Bank Ifsc</label>
                                    <input type="text" class="form-control" name="branch_ifsc" value="{{$staff->bank_info->bank_ifsc}}" />
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
                                    <input type="text" hidden name="old_resume" value="{{$staff->doc_info->resume}}" />
                                    @if($staff->doc_info->resume != '')
                                    <div class="bg-success text-white py-1 px-2 mt-2">{{$staff->doc_info->resume}}</div>
                                    @endif
                                    <input type="text" hidden name="doc_id" value="{{$staff->doc_info->id}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Joining Letter (Pdf only)</label>
                                    <input type="file" class="form-control" name="join_letter" />
                                    <input type="text" hidden name="old_join_letter" value="{{$staff->doc_info->join_letter}}" />
                                    @if($staff->doc_info->join_letter != '')
                                    <div class="bg-success text-white py-1 px-2 mt-2">{{$staff->doc_info->join_letter}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Other Document (Pdf only)</label>
                                    <input type="file" class="form-control" name="other_doc" />
                                    <input type="text" hidden name="old_other_doc" value="{{$staff->doc_info->other_doc}}" />
                                    @if($staff->doc_info->other_doc != '')
                                    <div class="bg-success text-white py-1 px-2 mt-2">{{$staff->doc_info->other_doc}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Update </button>
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
