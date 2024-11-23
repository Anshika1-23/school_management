@extends('admin.layout')
@section('title','Add New Notice')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Notice Board'=>'admin/notice-list']])
            @slot('title') Add New Notice @endslot
            @slot('add_btn') @endslot
            @slot('active') Add New Notice  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
                <div class="page-content">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addNotice" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Title </label>
                                                <input type="text" class="form-control" placeholder="Title" name="title" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Notice </label>
                                                <textarea name="notice" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Notice Date </label>
                                                <input type="date" class="form-control" name=" date" value="{{date('Y-m-d')}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-4">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Message To</label>
                                                <select class="form-select" name="message_to" >
                                                    <option value="all" selected>Message to All</option>
                                                    @if(!empty($roles))
                                                        @foreach($roles as $role)
                                                           <option value="{{$role->id}}">{{$role->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
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
