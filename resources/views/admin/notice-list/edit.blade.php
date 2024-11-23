@extends('admin.layout')
@section('title','Edit Notice')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Notice Board'=>'admin/notice-list']])
            @slot('title') Edit Notice @endslot
            @slot('add_btn') @endslot
            @slot('active') Edit Notice  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
                <div class="page-content">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="editNotice" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                    
                                    @csrf
                                    {{method_field('PUT')}}
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Title </label>
                                                <input type="text" class="form-control" placeholder="Title" value="{{$notice->title}}" name="title" data-parsley-required="true"/> 
                                                <input type="text" class="id" hidden value="{{$notice->id}}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Notice </label>
                                                <textarea name="notice" class="form-control" rows="5">{{$notice->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Notice Date </label>
                                                <input type="date" class="form-control" name=" date" value="{{$notice->notice_date}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-4">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Message To</label>
                                                <select class="form-select" name="message_to" >
                                                    <option value="all" @if($notice->message_to == 'all') selected  @endif>Message to All</option>
                                                    @if(!empty($roles))
                                                        @foreach($roles as $role)
                                                           <option value="{{$role->id}}" @if($notice->message_to == $role->id) selected  @endif>{{$role->title}}</option>
                                                        @endforeach
                                                    @endif    
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
