@extends('admin.layout')
@section('title','Assign Subject Teacher')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Assign Subject @endslot
    @slot('add_btn') <a href="{{url('admin/assign-subject-teacher/create')}}" class="btn btn-sm btn-primary">+ Assign Subject</a> @endslot
    @slot('active') Assign Subject  @endslot
@endcomponent
<!-- /.content-header -->
<div class="page-content">
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Select Criteria</h5>
        </div>
        <div class="card-body">
            <form id="assignSubject-form" method="POST" class="row">
                @csrf
                <div class="form-group col-md-6">
                    <select name="class" class="form-select class-select">
                        <option value="" selected disabled>Select Class</option>
                        @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <select name="section" class="form-select section-select">
                        <option value="" selected disabled>First Select Class</option>
                    </select>
                </div>
                <div class="col-12">
                    <input type="text" hidden name="type" value="table">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="section show-assigned-subjects"></section>
</div>
@stop