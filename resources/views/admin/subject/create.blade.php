@extends('admin.layout')
@section('title','Add New Subject')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Subject'=>'admin/subjects']])
            @slot('title') Add Subject @endslot
            @slot('add_btn') <a href="{{url('admin/subjects/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Subject  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
                <div class="page-content">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addSubject" method="POST" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                            <label class="form-label"> Subject </label>
                                            <input type="text" class="form-control" placeholder="Subject Name" name="title" data-parsley-required="true"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group mandatory">
                                            <label class="form-label">Subject Type</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="title_type" value="0" id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Theory
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="title_type" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Practical
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-12 col-12">
                                        <button type="submit" class="btn btn-primary"> Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@stop
