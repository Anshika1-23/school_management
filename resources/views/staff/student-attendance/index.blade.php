@extends('staff.layout')
@section('title','Student Attandance')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index']])
            @slot('title') Student Attandance @endslot
            @slot('add_btn')  @endslot
            @slot('active') Student Attandance  @endslot
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
                                                <label class="form-label">Date</label>
                                                <input type="date" class="form-control att-date" placeholder="Date" name="date"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 mt-4">
                                            <button type="button" class="btn btn-primary student-attandance"> Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 attendance-table" style="display:none;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Attendance</h4>
                        </div>
                        <form  id="add-attendance" method="POST">
                        @csrf
                            <div class="card-content">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary"> Mark Holiday </button>
                                </div>
                                <!-- table head dark -->
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>S No.</th>
                                                <th>Class (Section)</th>
                                                <th>Student Name</th>
                                                <th>Attendance</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Table head options end -->
                                <div class="col-md-12 col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary"> Save Attendance </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @stop
       