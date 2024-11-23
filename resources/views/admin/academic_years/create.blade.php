@extends('admin.layout')
@section('title','Add New Academic Year')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Academic Years'=>'admin/academic_years']])
            @slot('title') Add Academic Year @endslot
            @slot('add_btn') @endslot
            @slot('active') Add New  @endslot
        @endcomponent
        <div class="page-content">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form id="addAcademicYear" method="POST" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label class="form-label"> Title </label>
                                        <input type="text" class="form-control" placeholder="Title" name="title" data-parsley-required="true"/> 
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label">Year</label>
                                        <input type="text" class="form-control" placeholder="Year" name="year" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" placeholder="Start Date" name="start_date" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" placeholder="End Date" name="end_date" data-parsley-required="true"/>
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
