@extends('admin.layout')
@section('title','Add New Assign Class Teacher')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Assign Class Teacher'=>'admin/assign-class-teacher']])
            @slot('title') Add Assign Class Teacher @endslot
            @slot('add_btn') @endslot
            @slot('active') Add New  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
                <div class="page-content">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addAssignClassTeacher" method="POST" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Class Name</label>
                                                <select class="form-select class-select" name="class_id" id="basicSelect">
                                                    <option value="" selected disabled>Select Class Name</option>
                                                    @if(!empty($class))
                                                        @foreach($class as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
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
                                                    <!-- @php $class = yb_get_class_section($class); @endphp -->
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
                                                            <option value="{{$types->id}}">{{$types->f_name}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <button type="submit" class="btn btn-primary"> Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@stop
