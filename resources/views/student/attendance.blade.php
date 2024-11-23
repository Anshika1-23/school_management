@extends('student.layout')
@section('title','Attendance')
@section('content')
<div id="app">
    <div id="main" class="layout-horizontal">
        @include('student/components/top-header')
        <div class="content-wrapper container">
            <div class="page-heading">
                <h3 class="d-inline">Attendance</h3>
            </div>
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <form class="row" id="show-student-attendance">
                            <div class="form-group col-md-4">
                                <label for="">Select Month</label>
                                <select name="month" class="form-select">
                                    <option value="" selected disabled>Month</option>
                                    @for($i=1;$i<=12;$i++)
                                        <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>  
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Select Year</label>
                                <select name="year" class="form-select">
                                    <option value="" selected disabled>Year</option>
                                    @for($i=date('Y');$i<=(date('Y')+25);$i++)
                                        <option value="{{$i}}">{{$i}}</option>  
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="submit" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>

                <div class="attendance-box"></div>
            </div>
        </div>
    </div>
</div>


