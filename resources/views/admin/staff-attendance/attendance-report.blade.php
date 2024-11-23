@extends('admin.layout')
@section('title','Staff Attandance Report')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Staff Attandance Report @endslot
            @slot('add_btn')  @endslot
            @slot('active') Staff Attandance Report @endslot
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
                                                <label class="form-label">Month/Year</label>
                                                <input type="month" class="form-control att-month" placeholder="Month" name="month"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 mt-4">
                                            <button type="button" class="btn btn-primary attandance-report"> Search </button>
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
       