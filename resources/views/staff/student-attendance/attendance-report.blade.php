@extends('staff.layout')
@section('title','Student Attandance Report')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index']])
            @slot('title') Student Attandance Report @endslot
            @slot('add_btn')  @endslot
            @slot('active') Student Attandance Report @endslot
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
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label class="form-label">Class Name</label>
                                                <select class="form-select class-select std-class" name="class_id" id="basicSelect">
                                                    <option value="" selected disabled>Select Class Name</option>
                                                    @if(!empty($class))
                                                        @foreach($class as $types)
                                                            <option value="{{$types->class_name->id}}" data-sections="{{$types->sections}}">{{$types->class_name->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Section Name</label>
                                                <select class="form-select section-select class-section" name="section_id" id="basicSelect">
                                                    <option disabled selected value="" >First Select Class Name</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Month/Year</label>
                                                <input type="month" class="form-control att-month" placeholder="Month/Year" name="Month"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 mt-4">
                                            <button type="button" class="btn btn-primary student-att-report"> Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h4 class="card-title">Staff Attendance Report</h4>
                        </div> -->
                        <div class="card-content">
                            <!-- table head dark -->
                            <div class="table-responsive att-table"></div>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
        @stop
       