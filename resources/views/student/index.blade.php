@extends('student.layout')
@section('title','Index')
@section('content')
<div id="app">
    <div id="main" class="layout-horizontal">
        @include('student/components/top-header')
        <div class="content-wrapper container">
            <div class="page-heading">
                <h3>Student Details</h3>
            </div>
            <div class="page-content">
                @if($student)
                <section class="row">
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h4 class="card-title mb-0">My Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center mb-4">
                                        <div class="avatar avatar-xl">
                                            @if($student->student_photo != '')
                                                <img id="image" src="{{asset('public/student/'.$student->student_photo)}}" alt="" width="85px">
                                            @else
                                                <img id="image" src="{{asset('public/student/default.png')}}" alt="" width="85px">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                        <h6 class="text-muted font-semibold">Student Name</h6>
                                        <h6 class="font-extrabold mb-0">{{$student->first_name}}</h6>
                                    </div><hr class="my-2">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                        <h6 class="text-muted font-semibold">Admission Number</h6>
                                        <h6 class="font-extrabold mb-0">{{$student->admission_no}}</h6>
                                    </div><hr class="my-2">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                        <h6 class="text-muted font-semibold">Roll Number</h6>
                                        <h6 class="font-extrabold mb-0">{{$student->roll_no}}</h6>
                                    </div><hr class="my-2">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                        <h6 class="text-muted font-semibold">Class</h6>
                                        <h6 class="font-extrabold mb-0">{{$student->class_name->title}}</h6>
                                    </div><hr class="my-2">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                        <h6 class="text-muted font-semibold">Section</h6>
                                        <h6 class="font-extrabold mb-0">{{$student->section_name->title}}</h6>
                                    </div><hr class="my-2">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                        <h6 class="text-muted font-semibold">Gender</h6>
                                        <h6 class="font-extrabold mb-0">
                                            @if($student->gender == '0')
                                               Male
                                            @elseif($student->gender == '1')
                                                Female
                                            @else
                                                Other
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Parent Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Father Name</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->father_name}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Occupation</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->f_occupation}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Phone Number</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->father_phoneNumber}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Mother Name</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->mother_name}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Occupation</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->m_occupation}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Phone Number</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->mother_phoneNumber}}</h6>
                                        </div> <hr class="my-2">  
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Guardians Name</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->guardian_name}}</h6>
                                        </div> <hr class="my-2">  
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Email Address</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->guardian_email}}</h6>
                                        </div> <hr class="my-2">  
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Phone Number</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->guardian_phone}}</h6>
                                        </div><hr class="my-2">   
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Relation with Guardian</h6>
                                            <h6 class="font-extrabold mb-0">
                                                @if($student->parent_name->guardian_relation == '1')
                                                   Father
                                                @else
                                                   Mother
                                                @endif
                                            </h6>
                                        </div><hr class="my-2">   
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Occupation</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->guardian_occupation}}</h6>
                                        </div> <hr class="my-2"> 
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Guardian Address</h6>
                                            <h6 class="font-extrabold mb-0">{{$student->parent_name->guardian_address}}</h6>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Personal Info</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Admission Date</h6>
                                    <h6 class="font-extrabold mb-0">{{date('d M, Y',strtotime($student->admission_date))}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Date Of Birth</h6>
                                    <h6 class="font-extrabold mb-0">{{date('d M, Y',strtotime($student->date_of_birth))}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Religion</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->religion_name->title}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Phone Number</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->phone}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Email Address</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->email}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Present Address</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->current_address}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Permanent Address</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->permanent_address}}</h6>
                                </div>   
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Information Other</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Blood Group</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->blood_name->title}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Height</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->height}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">Weight</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->weight}}</h6>
                                </div><hr class="my-2">
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                    <h6 class="text-muted font-semibold">National Identification Number</h6>
                                    <h6 class="font-extrabold mb-0">{{$student->national_id_no}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
            </div>
        </div>
    </div>        
</div>
@stop   