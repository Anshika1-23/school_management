@extends('staff.layout')
@section('title','Index')
@section('content')
<div id="app">
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <a href="{{url('staff/logout')}}" class="float-start float-lg-end">LogOut</a>
            </div>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <i class="iconly-boldInfo-Square"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">My Classes</h6>
                                            <h6 class="font-extrabold mb-0">{{$classes}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">My Subjects</h6>
                                            <h6 class="font-extrabold mb-0">{{$subjects}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon green mb-2">
                                                <i class="iconly-boldAdd-User"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Following</h6>
                                            <h6 class="font-extrabold mb-0">80.000</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon red mb-2">
                                                <i class="iconly-boldBookmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Saved Post</h6>
                                            <h6 class="font-extrabold mb-0">112</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                {{-- <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="{{asset('assets/images/user.png')}}" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">{{session()->get('f_name')}}</h5>
                                    <h6 class="text-muted mb-0">@johnducky</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Notice Board</h4>
                        </div>
                        <div class="card-body">
                            @if($notice->isNotEmpty())
                            <div class="accordion" id="noticeAccordion">
                            @foreach($notice as $notice)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="noticeHeading{{$notice->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$notice->id}}" aria-expanded="false" aria-controls="collapse{{$notice->id}}">
                                    {{$notice->title}} [ Date : {{date('d M, Y',strtotime($notice->notice_date))}} ] Notice To : {{$notice->message_to}}
                                    </button>
                                </h2>
                                <div id="collapse{{$notice->id}}" class="accordion-collapse collapse" aria-labelledby="noticeHeading{{$notice->id}}" data-bs-parent="#noticeAccordion">
                                    <div class="accordion-body">
                                    {{$notice->description}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </div>
                            @else
                            <h6>No Notices Found.</h6>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Applied Leaves</h4>
                        </div>
                        <div class="card-body">
                            @if($student_leaves->isNotEmpty())
                            <div class="accordion" id="noticeAccordion">
                            @foreach($student_leaves as $leaves)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Leave Type</th>
                                        <th>Applied Date</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$leaves->student_name->full_name}}</td>
                                        <td>{{$leaves->leave_title->title}}</td>
                                        <td>{{date('d M, Y',strtotime($leaves->apply_date))}}</td>
                                        <td>{{date('d M, Y',strtotime($leaves->leave_from))}}</td>
                                        <td>{{date('d M, Y',strtotime($leaves->leave_to))}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @endforeach
                            <a href="{{url('staff/std-apply-leave')}}" class="btn btn-primary">View All</a>
                            </div>
                            @else
                            <h6>No Leaves Found.</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @stop
