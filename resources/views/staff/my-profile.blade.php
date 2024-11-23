@extends('staff.layout')
@section('title','My Profile')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index']])
            @slot('title') My Profile @endslot
            @slot('add_btn') @endslot
            @slot('active') My Profile @endslot
        @endcomponent
        <!-- /.content-header -->
        <section id="multiple-column-form">
            @if($teacher)
            <div class="row match-height">
                <div class="col-6 col-lg-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="card-title mb-0">My Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center mb-4">
                                <div class="avatar avatar-xl">
                                    @if($teacher->img != '')
                                        <img id="image" src="{{asset('public/staff/'.$teacher->img)}}" alt="" width="85px">
                                    @else
                                        <img id="image" src="{{asset('public/staff/default.png')}}" alt="" width="85px">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Teacher Name</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->f_name}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Role</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->role_name->title}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Designation</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->designation_name->title}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Department</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->department_name->title}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Date of Joining</h6>
                                <h6 class="font-extrabold mb-0">{{date('d M, Y',strtotime($teacher->date_of_joining))}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Gender</h6>
                                <h6 class="font-extrabold mb-0">
                                    @if($teacher->gender == '0')
                                        Male
                                    @elseif($teacher->gender == '1')
                                        Female
                                    @else
                                        Other
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="card-title mb-0">Personal Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Mobile No</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->emergency_mobile}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Email</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->email}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Driving License</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->driving_license}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Date Of Birth</h6>
                                <h6 class="font-extrabold mb-0">{{date('d M, Y',strtotime($teacher->dob))}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Marital Status</h6>
                                <h6 class="font-extrabold mb-0">
                                    @if($teacher->marital_status == '0')
                                        Unmarried
                                    @else
                                        Married
                                    @endif
                                </h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Father Name</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->father_name}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Mother Name</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->mother_name}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Qualifications</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->qualification}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Experience</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->experience}}</h6>
                            </div><hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Address</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->address}}</h6>
                            </div>
                            <hr class="my-2">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                <h6 class="text-muted font-semibold">Permanent Address</h6>
                                <h6 class="font-extrabold mb-0">{{$teacher->permanent_address}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
    @stop