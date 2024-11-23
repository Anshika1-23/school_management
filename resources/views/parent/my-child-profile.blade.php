@extends('parent.layout')
@section('title','Index')
@section('content')
<div id="app">
    <div id="main" class="layout-horizontal">
        @include('parent/components/top-header')
        <div class="content-wrapper container">
            <div class="page-heading">
                <h3>My Children Details</h3>
            </div>
            <div class="page-content">
                @if($parent)
                <section class="row">
                    <div class="col-12 col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Parent Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <div class="avatar avatar-xl">
                                                @if($parent->father_img != '')
                                                    <img id="image" src="{{asset('public/father/'.$parent->father_img)}}" alt="" width="85px">
                                                @else
                                                    <img id="image" src="{{asset('public/father/default.png')}}" alt="" width="85px">
                                                @endif
                                            </div>
                                            <h6 class="text-muted font-semibold mx-3 my-3">Father Name</h6>
                                            <h6 class="font-extrabold mb-0 ms-auto mx-3 my-3">{{$parent->father_name}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Occupation</h6>
                                            <h6 class="font-extrabold mb-0">{{$parent->f_occupation}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Phone Number</h6>
                                            <h6 class="font-extrabold mb-0">{{$parent->father_phoneNumber}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <div class="avatar avatar-xl">
                                                @if($parent->mother_img != '')
                                                    <img id="image" src="{{asset('public/mother/'.$parent->mother_img)}}" alt="" width="85px">
                                                @else
                                                    <img id="image" src="{{asset('public/mother/default.png')}}" alt="" width="85px">
                                                @endif
                                            </div>
                                            <h6 class="text-muted font-semibold mx-3 my-3">Mother Name</h6>
                                            <h6 class="font-extrabold ms-auto mb-0 mx-3 my-3">{{$parent->mother_name}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Occupation</h6>
                                            <h6 class="font-extrabold mb-0">{{$parent->m_occupation}}</h6>
                                        </div><hr class="my-2">
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Phone Number</h6>
                                            <h6 class="font-extrabold mb-0">{{$parent->mother_phoneNumber}}</h6>
                                        </div> <hr class="my-2">  
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <div class="avatar avatar-xl">
                                                @if($parent->mother_img != '')
                                                    <img id="image" src="{{asset('public/mother/'.$parent->mother_img)}}" alt="" width="85px">
                                                @else
                                                    <img id="image" src="{{asset('public/mother/default.png')}}" alt="" width="85px">
                                                @endif
                                            </div>
                                            <h6 class="text-muted font-semibold mx-3 my-3">Guardians Name</h6>
                                            <h6 class="font-extrabold ms-auto mb-0 mx-3 my-3">{{$parent->guardian_name}}</h6>
                                        </div> <hr class="my-2">  
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Email Address</h6>
                                            <h6 class="font-extrabold mb-0">{{$parent->guardian_email}}</h6>
                                        </div> <hr class="my-2">  
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Phone Number</h6>
                                            <h6 class="font-extrabold mb-0">{{$parent->guardian_phone}}</h6>
                                        </div><hr class="my-2">   
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Relation with Guardian</h6>
                                            <h6 class="font-extrabold mb-0">
                                                @if($parent->guardian_relation == '1')
                                                   Father
                                                @else
                                                   Mother
                                                @endif
                                            </h6>
                                        </div><hr class="my-2">   
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Occupation</h6>
                                            <h6 class="font-extrabold mb-0">{{$parent->guardian_occupation}}</h6>
                                        </div> <hr class="my-2"> 
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">Guardian Address</h6>
                                            <h6 class="font-extrabold mb-0">{{$parent->guardian_address}}</h6>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-6">
                        @foreach($parent->student_name as $item)
                        <div class="card">
                            <div class="card-header">
                                <h4>My Children Profile Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                My Child Profile
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center mb-4">
                                                            <div class="avatar avatar-xl">
                                                                @if($item->student_photo != '')
                                                                    <img id="image" src="{{asset('public/student/'.$item->student_photo)}}" alt="" width="85px">
                                                                @else
                                                                    <img id="image" src="{{asset('./public/student/default.png')}}" alt="" width="85px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                            <h6 class="text-muted font-semibold">Student Name</h6>
                                                            <h6 class="font-extrabold mb-0">{{$item->first_name}}</h6>
                                                        </div><hr class="my-2">
                                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                            <h6 class="text-muted font-semibold">Admission Number</h6>
                                                            <h6 class="font-extrabold mb-0">{{$item->admission_no}}</h6>
                                                        </div><hr class="my-2">
                                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                            <h6 class="text-muted font-semibold">Roll Number</h6>
                                                            <h6 class="font-extrabold mb-0">{{$item->roll_no}}</h6>
                                                        </div><hr class="my-2">
                                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                            <h6 class="text-muted font-semibold">Class</h6>
                                                            <h6 class="font-extrabold mb-0">{{$item->class_name->title}}</h6>
                                                        </div><hr class="my-2">
                                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                            <h6 class="text-muted font-semibold">Section</h6>
                                                            <h6 class="font-extrabold mb-0">{{$item->section_name->title}}</h6>
                                                        </div><hr class="my-2">
                                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                            <h6 class="text-muted font-semibold">Gender</h6>
                                                            <h6 class="font-extrabold mb-0">
                                                                @if($item->gender == '0')
                                                                Male
                                                                @elseif($item->gender == '1')
                                                                    Female
                                                                @else
                                                                    Other
                                                                @endif
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Personal Info
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="card-body">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Admission Date</h6>
                                                        <h6 class="font-extrabold mb-0">{{date('d M, Y',strtotime($item->admission_date))}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Date Of Birth</h6>
                                                        <h6 class="font-extrabold mb-0">{{date('d M, Y',strtotime($item->date_of_birth))}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Religion</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->religion_name->title}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Phone Number</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->phone}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Email Address</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->email}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Present Addressr</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->current_address}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Permanent Address</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->permanent_address}}</h6>
                                                    </div>   
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Information Other
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="card-body">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Blood Group</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->blood_name->title}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Height</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->height}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">Weight</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->weight}}</h6>
                                                    </div><hr class="my-2">
                                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-between">
                                                        <h6 class="text-muted font-semibold">National Identification Number</h6>
                                                        <h6 class="font-extrabold mb-0">{{$item->national_id_no}}</h6>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>
        </div>
    </div>        
</div>
@stop   