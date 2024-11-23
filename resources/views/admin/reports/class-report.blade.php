@extends('admin.layout')
@section('title','Class Report')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Class Report @endslot
            @slot('add_btn')  @endslot
            @slot('active') Class Report  @endslot
        @endcomponent
        <!-- /.content-header -->
         <!-- // Basic multiple Column Form section start -->
         <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-5 col-6">
                                            <div class="form-group">
                                                <label class="form-label">Class Name</label>
                                                <select class="form-select class-select std-class" name="class_id" id="basicSelect">
                                                    <option value="" selected disabled>Select Class Name</option>
                                                    @if(!empty($class))
                                                        @foreach($class as $types)
                                                            <option value="{{$types->id}}" data-sections="{{$types->sections}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Section Name</label>
                                                <select class="form-select section-select class-section" name="section_id" id="basicSelect">
                                                    <option disabled selected value="" >First Select Class Name</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 mt-4">
                                            <button type="button" class="btn btn-primary stdClass-report"> Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 classReport-table" style="display:none;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Class Report For Class And Section</h4>
                        </div>
                        <div class="card-content">
                            <!-- table head dark  -->
                            <div class="table-responsive text-center">
                                <table class="table table-bordered mb-0 ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Class Information</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <td>Number Of Student</td>
                                        <td class="std-count"></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @stop
       