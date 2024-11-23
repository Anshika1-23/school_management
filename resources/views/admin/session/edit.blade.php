@extends('admin.layout')
@section('title','Edit Session')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Session'=>'admin/sessions']])
            @slot('title') Edit Session @endslot
            @slot('add_btn')  @endslot
            @slot('active') Edit Session  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="editSession" method="POST" data-parsley-validate>
                                    @csrf
                                    {{ method_field('PUT') }}
                                    @if($session)
                                    <input type="hidden" class="url" value="{{url('admin/sessions/'.$session->id)}}">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                            <label class="form-label"> Session </label>
                                            <input type="text" class="form-control" placeholder="Session Name" name="title" value="{{$session->title}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Status </label>
                                                <select class="form-select" name="status" id="basicSelect">
                                                    <option value="" selected disabled>Select Status</option>    
                                                    <option value="1"  {{($session->status == "1" ? "selected":"") }}>Active</option>
                                                    <option value="0"  {{($session->status == "0" ? "selected":"") }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Start Date</label>
                                                <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="{{$session->start_date}}" data-parsley-required="true"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">End Date</label>
                                                <input type="date" class="form-control" placeholder="End Date" name="end_date" value="{{$session->end_date}}" data-parsley-required="true"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <button type="submit" class="btn btn-primary"> Update </button>
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@stop
