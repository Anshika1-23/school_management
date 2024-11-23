@extends('admin.layout')
@section('title','Add Leave Define')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Leave Define'=>'admin/l-define']])
            @slot('title') Add Leave Define @endslot
            @slot('add_btn') <a href="{{url('admin/l-define/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Leave Define  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addDefine" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Role </label>
                                                <select  id="role" class="form-select add-role" name="role" id="basicSelect">
                                                    <option value="" selected disabled>Select Role</option>
                                                    @if(!empty($role))
                                                        @foreach($role as $types)
                                                            <option value="{{$types->id}}" @if($types->title=='Student') data-value="student" @endif>{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory staff" style="display: none;">
                                                <label class="form-label"> Staff </label>
                                                <select  id="role" class="form-select add-role" name="user" id="basicSelect">
                                                    <option value="" selected disabled>Select Staff</option>
                                                    @if(!empty($staff))
                                                        @foreach($staff as $types)
                                                            <option value="{{$types->id}}">{{$types->f_name}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <div class="form-group mandatory student" style="display:block;">
                                                <label class="form-label">class</label>
                                                <select class="form-select" name="stdclass" id="basicSelect">
                                                    <option value="" selected disabled>Select Class</option>
                                                    @if(!empty($stdClass))
                                                        @foreach($stdClass as $types)
                                                           <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="col-md-4 col-4">
                                            <div class="form-group mandatory student" style="display:block;">
                                                <label class="form-label">Section</label>
                                                <select class="form-select" name="section" id="basicSelect">
                                                    <option value="" selected disabled>Select Section</option>
                                                    @if(!empty($section))
                                                        @foreach($section as $types)
                                                           <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-4">
                                            <div class="form-group mandatory student" style="display:block;">
                                                <label class="form-label">Student Name</label>
                                                <select class="form-select" name="user" id="basicSelect">
                                                    <option value="" selected disabled>Select Student Name</option>
                                                    @if(!empty($student))
                                                        @foreach($student as $types)
                                                            <option value="{{$types->id}}">{{$types->first_name}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>     
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Leave Type</label>
                                                <select class="form-select" name="leave" id="basicSelect">
                                                    <option value="" selected disabled>Select Leave Type</option>
                                                    @if(!empty($leave))
                                                        @foreach($leave as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Days</label>
                                                <input type="number" class="form-control" placeholder="Days" name="day" data-parsley-required="true"/> 
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
     // ========================================
    // script for Add Role
    // ========================================
    $('#role').change(function(){
        var selectedItem = $(this).val();
        var a = $('option:selected').attr("data-value");
      
        if(a == "student"){
            $(".staff").css("display", "none");
            $(".student").css("display", "block");
        }else{
            $(".staff").css("display","block");
            $(".student").css("display","none");
        }
    });
</script>
@stop
