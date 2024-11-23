@extends('admin.layout')
@section('title','Edit Academic Year')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Academic Years'=>'admin/academic_years']])
            @slot('title') Edit Academic Year @endslot
            @slot('add_btn') @endslot
            @slot('active') Edit  @endslot
        @endcomponent
        <div class="page-content">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form id="updateAcademicYear" method="POST" data-parsley-validate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group mandatory">
                                        <label class="form-label"> Title </label>
                                        <input type="text" class="form-control" placeholder="Title" value="{{$academicYear->title}}" name="title" data-parsley-required="true"/> 
                                        <input type="text" class="id" hidden value="{{$academicYear->id}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Year</label>
                                        <input type="text" class="form-control" placeholder="Year" value="{{$academicYear->year}}" name="year" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" placeholder="Start Date" value="{{$academicYear->start_date}}" name="start_date" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" placeholder="End Date" value="{{$academicYear->end_date}}" name="end_date" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                        <option value="1" @if($academicYear->status == '1') selected @endif>Active</option>
                                        <option value="0" @if($academicYear->status == '0') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <button type="submit" class="btn btn-primary"> Update </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@stop
