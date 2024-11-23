@extends('admin.layout')
@section('title','Dashboard')
@section('content')
<div id="app">
    <div id="main">
        @component('admin.components.content-header',['breadcrumb'=>[]])
            @slot('title') Dashboard @endslot
            @slot('add_btn') @endslot
            @slot('active')  @endslot
        @endcomponent
        <div class="page-content">
            <section class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Students</h6>
                                    <h6 class="font-extrabold mb-0">{{$students}}</h6>
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
                                    <h6 class="text-muted font-semibold">Teachers</h6>
                                    <h6 class="font-extrabold mb-0">{{$teachers}}</h6>
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
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Staff</h6>
                                    <h6 class="font-extrabold mb-0">{{$staff}}</h6>
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
            </section>
            <section class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Notice Board</h5>
                        </div>
                        <div class="card-body">
                            @if($notices->isNotEmpty())
                            <div class="accordion" id="noticeAccordion">
                                @foreach($notices as $notice)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="noticeHeading{{$notice->id}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$notice->id}}" aria-expanded="false" aria-controls="collapse{{$notice->id}}">
                                        {{$notice->title}} [ Date : {{date('d M, Y',strtotime($notice->notice_date))}} ] Notice To : {{$notice->message_user != null ? $notice->message_user->title : 'Message to All'}}
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
            </section>
        </div>


@stop
