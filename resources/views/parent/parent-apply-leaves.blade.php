@extends('parent.layout')
@section('title','My Leaves1')
@section('content')
<div id="app">
    <div id="main" class="layout-horizontal">
        @include('parent/components/top-header')
        <div class="content-wrapper container">
            <div class="page-heading">
                <h3 class="d-inline">My Leaves</h3>
                <span><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default"> Add New </button></span>
            </div>
            <div class="page-content">
                <section class="row">
                    <!-- show data table component -->
                    @component('admin.components.data-table',['thead'=>
                        ['S NO.','Student Name','Type','From','To','Apply Date','Status','Action']
                    ])
                        @slot('table_id') leave-list @endslot
                    @endcomponent
                    <!--login form Modal -->
                    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Apply Leave </h4>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form id="add_parentLeave" method="POST">
                                    @csrf
                                    <input type="hidden" class="url" value="{{url('parent/parent-apply-leaves')}}" >
                                    <div class="modal-body">
                                        <label>Date: </label>
                                        <div class="form-group">
                                            <input type="date" placeholder="Enter Date" name="applyDate" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Student Name</label>
                                            <select class="form-select" name="std_id" id="basicSelect">
                                                <option value="" selected disabled>Select Student Name</option>
                                                @if(!empty($student))
                                                    @foreach($student as $types)
                                                        <option value="{{$types->id}}">{{$types->first_name}}</option>
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Leave Type</label>
                                            <select class="form-select" name="leave_type" id="basicSelect">
                                                <option value="" selected disabled>Select Leave Type</option>
                                                @if(!empty($LeaveType))
                                                    @foreach($LeaveType as $types)
                                                        <option value="{{$types->id}}">{{$types->title}}</option>
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Leave From: </label>
                                            <input type="date" placeholder="Enter Date" name="from_date" class="form-control">
                                        </div>
                                        <label>Leave To: </label>
                                        <div class="form-group">
                                            <input type="date" placeholder="Enter Date" name="to_date" class="form-control">
                                        </div>
                                        <label>Reason: </label>
                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  name="reason" placeholder="Enter Reason"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="d-none d-sm-block">Submit</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--login form Modal -->
                    <div class="modal fade text-left" id="view_parentLeave" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Leaves Apply View </h4>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <span id="id"></span>
                                    <hr>
                                    <strong>Apply Date :</strong>
                                    <span id="apply_date"></span>
                                    <hr>
                                    <strong>Leave From :</strong>
                                    <span id="leave_from"></span>
                                    <hr>
                                    <strong>Leave To :</strong>
                                    <span id="leave_to"></span>
                                    <hr>
                                    <strong>Leave Type:</strong>
                                    <span id="leave_type"></span>
                                    <hr>
                                    <strong>Reason:</strong>
                                    <span id="reason"></span>
                                    <hr>
                                    <strong>Status:</strong>
                                    <span id="status"></span>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#leave-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "parent-apply-leaves",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'user_name', name: 'type'},
            {data: 'leaveType_title', name: 'type'},
            {data: 'leave_from', name: 'from'},
            {data: 'leave_to', name: 'to'},
            {data: 'apply_date', name: 'apply_date'},
            {data: 'approve_status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true,
                sWidth: '100px'
            }
        ]
    });
</script>
@stop


