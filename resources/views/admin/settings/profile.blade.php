@extends('admin.layout')
@section('title','Profile Settings')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Profile Settings @endslot
            @slot('add_btn')  @endslot
            @slot('active') Profile Settings @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            @foreach($data as $item)
            <div class="row match-height">
                <form id="updateProfileSetting" method="POST">
                @csrf
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Admin Details</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label"> Admin Name </label>
                                                <input type="text" class="form-control" placeholder="Enter Name" name="admin_name"  value="{{$item->admin_name}}" /> 
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label"> Email </label>
                                                <input type="email" class="form-control" placeholder="Enter Email Name" name="admin_email" value="{{$item->admin_email}}" /> 
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label"> Username </label>
                                                <input type="text" class="form-control" placeholder="Enter Username" name="username"  value="{{$item->username}}"/> 
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Phone </label>
                                                <input type="number" class="form-control" placeholder="Enter Phone Number" name="phone"  value="{{$item->admin_phone}}"/> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary ">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="updatePassword" method="POST">
                    {{ csrf_field() }}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Current Password </label>
                                                <input type="password" class="form-control" placeholder="Enter Password" name="password" /> 
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label"> New Password</label>
                                                <input type="password" class="form-control"  id="password" placeholder="Enter New Password" name="new"/> 
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label"> Confirm Password </label>
                                                <input type="password" class="form-control" placeholder="Enter Confirm Password" name="new_confirm"/> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary ">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </section>
        @stop
       

