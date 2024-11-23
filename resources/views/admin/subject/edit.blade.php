@extends('admin.layout')
@section('title','Edit Subject')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Subject'=>'admin/subjects']])
            @slot('title') Edit Subject @endslot
            @slot('add_btn')  @endslot
            @slot('active') Edit Subject  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
                <div class="page-content">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="editSubject" method="POST" data-parsley-validate>
                                    @csrf
                                    {{ method_field('PUT') }}
                                    @if($subject)
                                    <input type="hidden" class="url" value="{{url('admin/subjects/'.$subject->id)}}">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                            <label class="form-label"> Class </label>
                                            <input type="text" class="form-control" placeholder="Subject Name" name="title" value="{{$subject->title}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Status </label>
                                                <select class="form-select" name="status" id="basicSelect">
                                                    <option value="" selected disabled>Select Status</option>    
                                                    <option value="1"  {{($subject->status == "1" ? "selected":"") }}>Active</option>
                                                    <option value="0"  {{($subject->status == "0" ? "selected":"") }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Subject Type</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="title_type" value="0" id="flexRadioDefault1" {{$subject->title_type== "0" ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Theory
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1" name="title_type" id="flexRadioDefault2" {{$subject->title_type== "1" ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Practical
                                                    </label>
                                                </div>
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
@stop
