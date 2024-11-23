@extends('admin.layout')
@section('title','Edit HomeWork')
@section('content')
<div id="app">
    <div id="main">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','HomeWork'=>'admin/homework']])
        @slot('title') Edit HomeWork @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit HomeWork @endslot
    @endcomponent
    <!-- /.content-header -->
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="editHomeWork" method="POST" data-parsley-validate>
                                @csrf
                                {{ method_field('PUT') }}
                                @if($homeWork)
                                <input type="hidden" class="url" value="{{url('admin/homework/'.$homeWork->id)}}">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label">Class Name</label>
                                            <select class="form-select class-select homework-class" name="class_id" id="basicSelect">
                                                <option value="" selected disabled>Select Class Name</option>
                                                @if(!empty($class))
                                                    @foreach($class as $types)
                                                        @if($homeWork->class_id == $types->id)
                                                            <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                        @else
                                                            <option value="{{$types->id}}" >{{$types->title}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label">Section Name</label>
                                            <select class="form-select section-select" name="section">
                                                <option disabled selected value="" >First Select Class Name</option>
                                                @if(!empty($section))
                                                    @foreach($section as $types)
                                                        @if($homeWork->section_id == $types->id)
                                                            <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                        @else
                                                            <option value="{{$types->id}}" >{{$types->title}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label">Subject Name</label>
                                            <select class="form-select subject-select" name="subject" >
                                                <option value="" selected disabled>Select Subject Name</option>
                                                @if(!empty($subject))
                                                    @foreach($subject as $types)
                                                        @if($homeWork->subject_id == $types->id)
                                                            <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                        @else
                                                            <option value="{{$types->id}}" >{{$types->title}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label">HomeWork Date </label>
                                            <input type="date" class="form-control from-date" name="work_date" value="{{$homeWork->homework_date}}" data-parsley-required="true"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label"> Submission Date </label>
                                            <input type="date" class="form-control to-date" name="submission_date" min="{{date('Y-m-d')}}" value="{{$homeWork->submission_date}}" data-parsley-required="true"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label"> Marks</label>
                                            <input type="number" class="form-control" name="mark" value="{{$homeWork->marks}}"> 
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label"> Status </label>
                                            <select class="form-select" name="status" id="basicSelect">
                                                <option value="" selected disabled>Select Status</option>    
                                                <option value="1" {{($homeWork->status == "1" ? "selected":"") }}>Active</option>
                                                <option value="0" {{($homeWork->status == "0" ? "selected":"") }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-8 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Attach File</label>
                                            <input type="hidden" class="form-control" name="old_att_file" value="{{$homeWork->file}}" />
                                            <input class="form-control" type="file" name="att_file">
                                            @if($homeWork->file != '')
                                            <span class="">Uploaded : <a href="{{asset('public/homework/'.$homeWork->file)}}" target="_blank" title="Click to View">{{$homeWork->file}}</a></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label"> Description </label>
                                            <textarea name="des" class="form-control" rows="5">{{$homeWork->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
