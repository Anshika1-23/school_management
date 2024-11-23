@extends('admin.layout')
@section('title','Edit Assign Class Teacher')
@section('content')
<div id="app">
    <div id="main">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Assign Class Teacher'=>'admin/assign-class-teacher']])
        @slot('title') Edit Assign Class Teacher @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit Assign Class Teacher @endslot
    @endcomponent
    <!-- /.content-header -->
    <!-- // Basic multiple Column Form section start -->
            <div class="page-content">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="editAssignClassTeacher" method="POST" data-parsley-validate>
                                @csrf
                                {{ method_field('PUT') }}
                                @if($assignTeacher)
                                <input type="hidden" class="url" value="{{url('admin/assign-class-teacher/'.$assignTeacher->id)}}">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label">Class Name</label>
                                            <select class="form-select class-select" name="class_id" id="basicSelect">
                                                <option value="" selected disabled>Select Class Name</option>
                                                @if(!empty($class))
                                                    @foreach($class as $types)
                                                        @if($assignTeacher->class_id == $types->id)
                                                            <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                        @else
                                                            <option value="{{$types->id}}" >{{$types->title}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label">Section Name</label>
                                            <select class="form-select section-select" name="section" id="basicSelect">
                                                <option disabled selected value="" >First Select Class Name</option>
                                                @if(!empty($section))
                                                    @foreach($section as $types)
                                                        @if($assignTeacher->section_id == $types->id)
                                                            <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                        @else
                                                            <option value="{{$types->id}}" >{{$types->title}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label">Teacher Name</label>
                                            <select class="form-select" name="teacher" id="basicSelect">
                                                <option value="" selected disabled>Select Teacher Name</option>
                                                @if(!empty($teacher))
                                                    @foreach($teacher as $types)
                                                        @if($assignTeacher->staff_id == $types->id)
                                                            <option value="{{$types->id}}" selected>{{$types->f_name}}</option>
                                                        @else
                                                            <option value="{{$types->id}}" >{{$types->f_name}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label"> Status </label>
                                            <select class="form-select" name="status" id="basicSelect">
                                                <option value="" selected disabled>Select Status</option>    
                                                <option value="1" {{($assignTeacher->status == "1" ? "selected":"") }}>Active</option>
                                                <option value="0" {{($assignTeacher->status == "0" ? "selected":"") }}>Inactive</option>
                                            </select>
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
@stop
