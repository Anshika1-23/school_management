@extends('staff.layout')
@section('title','Add New Student')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index','Student'=>'staff/students']])
            @slot('title') Add Student @endslot
            @slot('add_btn') <a href="{{url('staff/students/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Student  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <form id="addStudent" method="POST" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ACADEMIC INFORMATION</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Academic Year </label>
                                                    <select class="form-select" name="academic_year" id="basicSelect">
                                                        <option value="" selected disabled>Select Academic Year</option>
                                                        @if(!empty($academic))
                                                            @foreach($academic as $types)
                                                                <option value="{{$types->id}}">{{$types->year}}</option>
                                                            @endforeach
                                                        @endif    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Class </label>
                                                    <select class="form-select" name="stdClass" id="basicSelect">
                                                        <option value="" selected disabled>Select Student Class</option>
                                                        @if(!empty($class))
                                                            @foreach($class as $types)
                                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                            @endforeach
                                                        @endif    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Section </label>
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
                                            <div class="col-12">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Admission Number </label>
                                                    <input type="number" class="form-control" placeholder="Admission Number" name="admission_no" value="{{$admission}}" data-parsley-required="true"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label"> Admission Date </label>
                                                    <input type="date" class="form-control" placeholder="Admission Date" name="admission_date"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label"> Roll Number </label>
                                                    <input type="number" class="form-control" placeholder="Roll Number" name="roll_no"/> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">PERSONAL INFO</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="f_name" placeholder="First Name"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Last Name </label>
                                                <input type="text" class="form-control" name="l_name" placeholder="Last Name"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Parent Name</label>
                                                <select class="form-select" name="parent" id="basicSelect">
                                                    <option value="" selected disabled>Select Parent Name</option>
                                                    @if(!empty($parent))
                                                        @foreach($parent as $types)
                                                            <option value="{{$types->id}}">{{$types->father_name. ' and ' .$types->mother_name}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Gender</label>
                                                <div class="form-check">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="form-check-input form-check-success" name="gender" value="0" id="radio">
                                                        <label class="form-check-label" for="radio">Male</label>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="form-check-input form-check-success" name="gender" value="1" id="radio1">
                                                        <label class="form-check-label" for="radio1">Female</label>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="form-check-input form-check-success" name="gender" value="-1" id="radio2" >
                                                        <label class="form-check-label" for="radio2">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Date OF Birth</label>
                                                <input type="date" class="form-control" name="dob" placeholder="Date OF Birth"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Birth Certificate Number</label>
                                                <input type="text" class="form-control" name="birth_certificate_no" placeholder="Birth Certificate Number"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">NATIONAL ID CARD</label>
                                                <input type="text" class="form-control" name="national_no" placeholder="National Id Card"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Religion </label>
                                                <select class="form-select" name="religion" id="basicSelect">
                                                    <option value="" selected disabled>Select Religion</option>
                                                    @if(!empty($religion))
                                                        @foreach($religion as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Caste</label>
                                                <input type="text" class="form-control" name="caste" placeholder="Caste"/> 
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Student Image</label>
                                                <input class="form-control" type="file" id="formFile" name="img" onChange="readURL(this);">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <img id="image" src="{{asset('assets/images/user.png')}}" alt="Face 1" width="85px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">CONTACT INFORMATION</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Phone Number</label>
                                                <input type="number" class="form-control" name="phone" placeholder="Phone Number"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Current Address</label>
                                                <input type="text" class="form-control" name="address" placeholder="Current Address"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Permanent Address</label>
                                                <input type="text" class="form-control" name="permanent_address" placeholder="Permanent Address"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">MEDICAL RECORD</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Blood Group</label>
                                                <select class="form-select" name="blood" id="basicSelect">
                                                    <option value="" selected disabled>Select Blood Group</option>
                                                    @if(!empty($blood))
                                                        @foreach($blood as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Student Category</label>
                                                <select class="form-select" name="category" id="basicSelect">
                                                    <option value="" selected disabled>Select Student Category</option>
                                                    @if(!empty($category))
                                                        @foreach($category as $types)
                                                            <option value="{{$types->id}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Height(IN)</label>
                                                <input type="text" class="form-control" name="height" placeholder="Height">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Weight(KG)</label>
                                                <input type="text" class="form-control" name="weight" placeholder="Weight">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-12 col-12">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </div>
            </form>
        </section>
        @stop
@section('pageJsScripts')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
@stop
