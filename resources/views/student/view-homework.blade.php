@extends('student.layout')
@section('title','View Homework')
@section('content')
<div id="app">
    <div id="main" class="layout-horizontal">
        @include('student/components/top-header')
        <div class="content-wrapper container">
            <div class="page-heading">
                <h3 class="d-inline">View Homework</h3>
            </div>
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Subject Name</td>
                                <td>{{$homework->subject_name->title}}</td>
                            </tr>
                            <tr>
                                <td>Marks</td>
                                <td>{{$homework->marks}}</td>
                            </tr>
                            <tr>
                                <td>Homework Date</td>
                                <td>{{date('d M, Y',strtotime($homework->homework_date))}}</td>
                            </tr>
                            <tr>
                                <td>Submission Date</td>
                                <td>{{date('d M, Y',strtotime($homework->submission_date))}}</td>
                            </tr>
                            <tr>
                                <td>Evaluation Date</td>
                                <td>
                                    @if($homework->evaluation_date != '')
                                    {{date('d M, Y',strtotime($homework->evaluation_date))}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{$homework->description}}</td>
                            </tr>
                            @if($homework->file != '')
                            <tr>
                                <td>File</td>
                                <td><a href="{{asset('public/homework/'.$homework->file)}}" target="_blank">View</a></td>
                            </tr>
                            @endif
                            <tr>
                                <td>Status</td>
                                <td>{{$homework->status == '1' ? 'Completed' : 'Pending'}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('pageJsScripts')

@stop


