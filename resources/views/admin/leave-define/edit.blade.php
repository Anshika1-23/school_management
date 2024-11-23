@extends('admin.layout')
@section('title','Edit Leave Define')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Leave Define'=>'admin/l-define']])
            @slot('title') Edit Leave Define @endslot
            @slot('add_btn')  @endslot
            @slot('active') Edit Leave Define  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="editDefine" method="POST" data-parsley-validate>
                                    @csrf
                                    {{ method_field('PUT') }}
                                    @if($define)
                                    <input type="hidden" class="url" value="{{url('admin/l-define/'.$define->id)}}">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Role </label>
                                                <select  id="role" class="form-select add-role" name="role" id="basicSelect">
                                                    <option value="" selected disabled>Select Role</option>
                                                    @if(!empty($role))
                                                        @foreach($role as $types)
                                                            @if($define->role == $types->id)
                                                                <option value="{{$types->id}}"  @if($types->title=='Student') data-value="student" @endif selected>{{$types->title}}</option>
                                                            @else
                                                                <option value="{{$types->id}}"  @if($types->title=='Student') data-value="student" @endif >{{$types->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        @if($define->leave_user == 'student')
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
                                        @else
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mandatory staff" style="display:block;">
                                                    <label class="form-label"> Staff </label>
                                                    <select  id="role" class="form-select add-role" name="user" id="basicSelect">
                                                        <option value="" selected disabled>Select Staff</option>
                                                        @if(!empty($staff))
                                                            @foreach($staff as $types)
                                                                @if($define->user_id == $types->id)
                                                                    <option value="{{$types->id}}" selected>{{$types->f_name}}</option>
                                                                @else
                                                                    <option value="{{$types->id}}">{{$types->f_name}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif    
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Leave Type</label>
                                                <select class="form-select" name="leave" id="basicSelect">
                                                    <option value="" selected disabled>Select Leave Type</option>
                                                    @if(!empty($leave))
                                                        @foreach($leave as $types)
                                                            @if($define->leave_type == $types->id)
                                                                <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                            @else
                                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Days</label>
                                                <input type="number" class="form-control" placeholder="Days" name="day" value="{{$define->days}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status" id="basicSelect">
                                                    <option value="" selected disabled>Select Status</option>    
                                                    <option value="1" {{($define->status == "1" ? "selected":"") }}>Active</option>
                                                    <option value="0" {{($define->status == "0" ? "selected":"") }}>Inactive</option>
                                                </select>
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
