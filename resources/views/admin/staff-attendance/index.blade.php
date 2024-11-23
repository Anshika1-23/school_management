@extends('admin.layout')
@section('title','Staff Attandance')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Staff Attandance @endslot
            @slot('add_btn')  @endslot
            @slot('active') Staff Attandance  @endslot
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
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Role </label>
                                                <select class="form-select att-role" name="role" id="basicSelect">
                                                    <option value="" selected disabled>Select Role</option>
                                                    @if(!empty($role))
                                                        @foreach($role as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Date</label>
                                                <input type="date" class="form-control att-date" placeholder="Date" name="date"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 mt-4">
                                            <button type="button" class="btn btn-primary staff-attandance"> Search </button>
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
                            <h4 class="card-title">Staff Attendance</h4>
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
                                                <th>Staff Name</th>
                                                <th>Role</th>
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
       