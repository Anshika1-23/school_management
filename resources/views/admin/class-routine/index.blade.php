@extends('staff.layout')
@section('title','Class Routine')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Class Routine @endslot
            @slot('add_btn')  @endslot
            @slot('active') Class Routine  @endslot
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
                                            <button type="button" class="btn btn-primary class-routine"> Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 classRoutine-table" style="display:block;">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="sunday-tab" data-bs-toggle="tab" href="#sunday" role="tab"
                                            aria-controls="sunday" aria-selected="true">Sunday</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="monday-tab" data-bs-toggle="tab" href="#monday" role="tab"
                                            aria-controls="monday" aria-selected="false">Monday</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tuesday-tab" data-bs-toggle="tab" href="#tuesday" role="tab"
                                            aria-controls="tuesday" aria-selected="false">Tuesday</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="wednesday-tab" data-bs-toggle="tab" href="#wednesday" role="tab"
                                            aria-controls="wednesday" aria-selected="false">Wednesday</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="thursday-tab" data-bs-toggle="tab" href="#thursday" role="tab"
                                            aria-controls="thursday" aria-selected="false">Thursday</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="friday-tab" data-bs-toggle="tab" href="#friday" role="tab"
                                            aria-controls="friday" aria-selected="false">Friday</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="saturday-tab" data-bs-toggle="tab" href="#saturday" role="tab"
                                            aria-controls="saturday" aria-selected="false">Saturday</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                                        <p class='my-2'>Hello Sunday</p>
                                    </div>
                                    <div class="tab-pane fade" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                                        <p class='my-2'>Hello Monday</p>
                                    </div>
                                    <div class="tab-pane fade" id="tuesday" role="tabpanel" aria-labelledby="tuesday-tab">
                                        <p class="mt-2">Hello Tuesday</p>
                                    </div>
                                    <div class="tab-pane fade" id="wednesday" role="tabpanel" aria-labelledby="wednesday-tab">
                                        <p class="mt-2">Hello Wednesday</p>
                                    </div>
                                    <div class="tab-pane fade" id="thursday" role="tabpanel" aria-labelledby="thursday-tab">
                                        <p class="mt-2">Hello Thursday</p>
                                    </div>
                                    <div class="tab-pane fade" id="friday" role="tabpanel" aria-labelledby="friday-tab">
                                        <p class="mt-2">Hello Friday</p>
                                    </div>
                                    <div class="tab-pane fade" id="saturday" role="tabpanel" aria-labelledby="saturday-tab">
                                        <p class="mt-2">Hello Saturday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Attendance</h4>
                        </div>
                        <form  id="add-classRoutine" method="POST">
                        @csrf
                            <div class="card-content">
                                table head dark 
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>S No.</th>
                                                <th>Class (Section)</th>
                                                <th>Student Name</th>
                                                <th>Attendance</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                 Table head options end 
                                <div class="col-md-12 col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary"> Save Attendance </button>
                                </div>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
        </section>
        @stop
       