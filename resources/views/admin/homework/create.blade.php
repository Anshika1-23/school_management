@extends('admin.layout')
@section('title','Add HomeWork')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','HomeWork'=>'admin/homework']])
            @slot('title') Add HomeWork @endslot
            @slot('add_btn') @endslot
            @slot('active') Add HomeWork  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addHomeWork" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                    
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Class Name</label>
                                                <select class="form-select class-select homework-class" name="class_id">
                                                    <option value="" selected disabled>Select Class Name</option>
                                                    @if(!empty($class))
                                                        @foreach($class as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Section Name</label>
                                                <select class="form-select section-select" name="section" >
                                                    <option disabled selected value="" >First Select Class Name</option>
                                                    <!-- @php $class = yb_get_class_section($class); @endphp -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Subject Name</label>
                                                <select class="form-select subject-select" name="subject" >
                                                    <option value="" selected disabled>First Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">HomeWork Date </label>
                                                <input type="date" class="form-control from-date" name="work_date" value="{{date('Y-m-d')}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Submission Date </label>
                                                <input type="date" class="form-control to-date" name="submission_date" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Marks</label>
                                                <input type="number" class="form-control" name="mark"> 
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Attach File</label>
                                                <input class="form-control" type="file" name="att_file">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Description </label>
                                                <textarea name="des" class="form-control" rows="5"></textarea>
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
            // $(function(){
            //     $('.from-date').change(function(){
            //         $('.to-date').attr('min',$(this).val());
            //     });
            // });
        </script>
        @endsection
