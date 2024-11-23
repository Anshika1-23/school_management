@extends('admin.layout')
@section('title','Add New Session')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Session'=>'admin/sessions']])
            @slot('title') Add Session @endslot
            @slot('add_btn') <a href="{{url('admin/sessions/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Session  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addSession" method="POST" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                            <label class="form-label"> Session </label>
                                            <input type="text" class="form-control" placeholder="Session Name" name="title" data-parsley-required="true"/> 
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@stop
