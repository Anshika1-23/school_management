@extends('admin.layout')
@section('title','Add Holiday')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Holiday'=>'admin/holiday']])
            @slot('title') Add Holiday @endslot
            @slot('add_btn') @endslot
            @slot('active') Add Holiday  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addHoliday" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                    
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
                                                <label class="form-label"> Details </label>
                                                <textarea name="details" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> From Date </label>
                                                <input type="date" class="form-control from-date" name=" from_date" value="{{date('Y-m-d')}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> To Date </label>
                                                <input type="date" class="form-control to-date" name=" to_date" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" data-parsley-required="true"/> 
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
            </div>
        </section>
        @stop
        @section('pageJsScripts')
        <script>
            $(function(){
                $('.from-date').change(function(){
                    $('.to-date').attr('min',$(this).val());
                });
            });
        </script>
        @endsection
