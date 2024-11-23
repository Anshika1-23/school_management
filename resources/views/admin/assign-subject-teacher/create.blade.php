@extends('admin.layout')
@section('title','Update Assign Subject')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Assign Subject'=>'admin/assign-subject-teacher']])
            @slot('title') Update Assign Subject @endslot
            @slot('add_btn') @endslot
            @slot('active') Update  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
                <div class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Select Criteria</h5>
                        </div>
                        <div class="card-body">
                            <form id="assignSubject-form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <div class="form-group mandatory">
                                            <select class="form-select class-select" name="class">
                                                <option value="" selected disabled>Select Class</option>
                                                @if($class->isNotEmpty())
                                                    @foreach($class as $types)
                                                        <option value="{{$types->id}}">{{$types->title}}</option>
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <select class="form-select section-select" name="section">
                                                <option disabled selected value="" >First Select Class</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <input type="text" hidden name="type" value="form">
                                        <button type="submit" class="btn btn-primary"> Search </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form id="assignedSubject-list" method="POST">
                        <section class="section show-assigned-subjects"></section>
                    </form>
                </div>
        
@stop
