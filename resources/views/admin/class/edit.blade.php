@extends('admin.layout')
@section('title','Edit Class')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Class'=>'admin/classes']])
            @slot('title') Edit Class @endslot
            @slot('add_btn')  @endslot
            @slot('active') Edit Class  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <div class="page-content">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form id="editClass" method="POST" data-parsley-validate>
                            @csrf
                            {{ method_field('PUT') }}
                            @if($class)
                            <input type="hidden" class="url" value="{{url('admin/classes/'.$class->id)}}">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                    <label class="form-label"> Class </label>
                                    <input type="text" class="form-control" placeholder="Class Name" name="title" value="{{$class->title}}" data-parsley-required="true"/> 
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label"> Status </label>
                                        <select class="form-select" name="status" id="basicSelect">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1"  {{($class->status == "1" ? "selected":"") }}>Active</option>
                                            <option value="0"  {{($class->status == "0" ? "selected":"") }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Section</label>
                                        @php
                                            $sectionClass = array_filter(explode(',',$class->section));
                                        @endphp
                                        @if(!empty($section))
                                            @foreach($section as $types)
                                            @php $checked = in_array($types->id,$sectionClass) ? 'checked' : '';  @endphp
                                            <div class="form-check">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="form-check-input form-check-success" id="section{{$types->id}}" name="section[]" class="section" value="{{$types->id}}" {{$checked}} data-parsley-required="true">
                                                    <label class="form-check-label" for="section{{$types->id}}">{{$types->title}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif 
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
@section('pageJsScripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function(){
        $('.select2').select2();
    });
</script>
@endsection