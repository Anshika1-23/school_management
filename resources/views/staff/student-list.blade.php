@extends('staff.layout')
@section('title','Student List')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Student List @endslot
            @slot('add_btn')  @endslot
            @slot('active') Student List  @endslot
        @endcomponent
        <!-- /.content-header -->
         <!-- // Basic multiple Column Form section start -->
         <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Academic Year</label>
                                                <select class="form-select" name="year" id="basicSelect">
                                                    <option value="" disabled>Select Academic Year</option>
                                                    @if(!empty($academicYear))
                                                        @foreach($academicYear as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}({{$types->year}})</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label class="form-label">Class Name</label>
                                                <select class="form-select class-select" name="class_id" id="basicSelect">
                                                    <option value="" selected disabled>Select Class Name</option>
                                                    @if(!empty($class))
                                                        @foreach($assign_class as $types)
                                                            <option value="{{$types->class_id}}" data-sections="{{$types->sections}}">{{$types->class_name->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Section Name</label>
                                                <select class="form-select section-select" name="section_id" id="basicSelect">
                                                    <option disabled selected value="" >First Select Class Name</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Search By Name</label>
                                                <input type="text" class="form-control" name="std_name" placeholder="Enter Search Name" data-parsley-required="true"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Roll Number</label>
                                                <input type="number" class="form-control" name="roll_no" placeholder="Enter Roll Number" data-parsley-required="true"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 mt-4">
                                            <button type="submit" class="btn btn-primary"> Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student List</h4>
                        </div>
                        <div class="card-content">
                            <!-- table head dark -->
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Admission No.</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Class(Section)</th>
                                            <th>Gender</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    @foreach($students as $type)
                                    <tbody>
                                        <tr>
                                            <td>{{$type->admission_no}}</td>
                                            <td>{{$type->first_name}}</td>
                                            <td>{{$type->parent_name->father_name}}</td>
                                            <td>{{$type->class_name->title}} ({{$type->section_name->title}})</td>
                                            <td>
                                                @if($type->gender == '0')
                                                    Male
                                                @elseif($type->gender == '1')
                                                    Female
                                                @else
                                                    Other
                                                @endif
                                            </td>
                                            <td>{{$type->category_name->title}}</td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <!-- Table head options end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @stop
       