@extends('staff.layout')
@section('title','Edit Student')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index','Student'=>'staff/students']])
            @slot('title') Edit Student @endslot
            @slot('add_btn')  @endslot
            @slot('active') Edit Student  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <form id="editStudent" method="POST" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                {{ method_field('PUT') }}
                @if($student)
                <input type="hidden" class="url" value="{{url('staff/students/'.$student->id)}}">
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
                                                        <option value="" disabled>Select Academic Year</option>
                                                        @if(!empty($academic))
                                                            @foreach($academic as $types)
                                                                @if($student->academic_id == $types->id)
                                                                    <option value="{{$types->id}}" selected>{{$types->year}}</option>
                                                                @else
                                                                    <option value="{{$types->id}}">{{$types->year}}</option>
                                                                @endif
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
                                                                @if($student->class_id == $types->id)
                                                                    <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                                @else
                                                                    <option value="{{$types->id}}">{{$types->title}}</option>
                                                                @endif
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
                                                                @if($student->section_id == $types->id)
                                                                    <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                                @else
                                                                    <option value="{{$types->id}}">{{$types->title}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mandatory">
                                                    <label class="form-label"> Admission Number </label>
                                                    <input type="number" class="form-control" placeholder="Admission Number" name="admission_no" value="{{$student->admission_no}}" data-parsley-required="true"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label"> Admission Date </label>
                                                    <input type="date" class="form-control" placeholder="Admission Date" value="{{$student->admission_date}}"  name="admission_date" /> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label"> Roll Number </label>
                                                    <input type="number" class="form-control" placeholder="Roll Number" value="{{$student->roll_no}}" name="roll_no"/> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-select" name="status" id="basicSelect">
                                                        <option value="" selected disabled>Select Status</option>    
                                                        <option value="1" {{($student->status == "1" ? "selected":"") }}>Active</option>
                                                        <option value="0" {{($student->status == "0" ? "selected":"") }}>Inactive</option>
                                                    </select>
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
                                                <input type="text" class="form-control" name="f_name" value="{{$student->first_name}}" placeholder="First Name"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Last Name </label>
                                                <input type="text" class="form-control" name="l_name" value="{{$student->last_name}}" placeholder="Last Name"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label"> Parent Name</label>
                                                <select class="form-select" name="parent" id="basicSelect">
                                                    <option value="" selected disabled>Select Parent Name</option>
                                                    @if(!empty($parent))
                                                        @foreach($parent as $types)
                                                            @if($student->parent_id == $types->id)
                                                                <option value="{{$types->id}}" selected>{{$types->father_name. ' and ' .$types->mother_name}}</option>
                                                            @else
                                                                <option value="{{$types->id}}">{{$types->father_name. ' and ' .$types->mother_name}}</option>
                                                            @endif
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
                                                        <input type="radio" class="form-check-input form-check-success" name="gender" value="0" id="radio" {{ $student->gender == "0" ? "checked":"" }}>
                                                        <label class="form-check-label" for="radio">Male</label>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="form-check-input form-check-success" name="gender" value="1" id="radio1" {{ $student->gender == "1" ? "checked":"" }}>
                                                        <label class="form-check-label" for="radio1">Female</label>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="form-check-input form-check-success" name="gender" value="-1" id="radio2" {{ $student->gender == "-1" ? "checked":"" }}>
                                                        <label class="form-check-label" for="radio2">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Date OF Birth</label>
                                                <input type="date" class="form-control" name="dob" value="{{ $student->date_of_birth }}" placeholder="Date OF Birth"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Birth Certificate Number</label>
                                                <input type="text" class="form-control" name="birth_certificate_no"  value="{{ $student->birth_certificate_no }}" placeholder="Birth Certificate Number"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">NATIONAL ID CARD</label>
                                                <input type="text" class="form-control" name="national_no" value="{{ $student->national_id_no }}" placeholder="National Id Card"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label"> Religion </label>
                                                <select class="form-select" name="religion" id="basicSelect">
                                                    <option value="" selected disabled>Select Religion</option>
                                                    @if(!empty($religion))
                                                        @foreach($religion as $types)
                                                            @if($student->religion_id == $types->id)
                                                                <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                            @else
                                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Caste</label>
                                                <input type="text" class="form-control" name="caste" value="{{$student->caste}}" placeholder="Caste"/> 
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Student Image</label>
                                                <input type="hidden" class="form-control" name="old_img" value="{{$student->student_photo}}" />
                                                <input class="form-control" type="file" id="formFile" name="img" onChange="readURL(this);">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            @if($student->student_photo != '')
                                                <img id="image" src="{{asset('public/student/'.$student->student_photo)}}" alt="" width="85px">
                                            @else
                                                <img id="image" src="{{asset('public/student/user.png')}}" alt="" width="85px">
                                            @endif
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
                                                <input type="email" class="form-control" name="email" value="{{$student->email}}" placeholder="Email" disabled>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Phone Number</label>
                                                <input type="number" class="form-control" name="phone" value="{{$student->phone}}" placeholder="Phone Number"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Current Address</label>
                                                <input type="text" class="form-control" name="address" value="{{$student->current_address}}" placeholder="Current Address"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Permanent Address</label>
                                                <input type="text" class="form-control" name="permanent_address" value="{{$student->permanent_address}}" placeholder="Permanent Address"/>
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
                                                            @if($student->bloodgroup_id == $types->id)
                                                                <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                            @else
                                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                            @endif
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
                                                            @if($student->student_category_id == $types->id)
                                                                <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                            @else
                                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Height(IN)</label>
                                                <input type="text" class="form-control" name="height" value="{{$student->height}}" placeholder="Height">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Weight(KG)</label>
                                                <input type="text" class="form-control" name="weight" value="{{$student->weight}}" placeholder="Weight">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-12 col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                @endif
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

