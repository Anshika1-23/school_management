@extends('admin.layout')
@section('title','Add New Class')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Class'=>'admin/classes']])
            @slot('title') Add Class @endslot
            @slot('add_btn') <a href="{{url('admin/classes/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Class  @endslot
        @endcomponent
        <!-- /.content-header -->
        <div class="page-content">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form id="addClass" method="POST" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group mandatory">
                                    <label class="form-label"> Class </label>
                                    <input type="text" class="form-control" placeholder="Class Name" name="title" data-parsley-required="true"/> 
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Section</label>
                                        @if(!empty($section))
                                            @foreach($section as $types)
                                            <div class="form-check">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="form-check-input form-check-success" name="section[]" id="section{{$types->id}}"  class="section" value="{{$types->id}}" data-parsley-required="true">
                                                    <label class="form-check-label" for="section{{$types->id}}">{{$types->title}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif 
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
@stop
@section('pageJsScripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function(){
        $('.select2').select2();
    });
</script>
@endsection
