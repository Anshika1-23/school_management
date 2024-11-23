@extends('admin.layout')
@section('title','Apply Leave')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Apply Leave @endslot
            @slot('add_btn') @endslot
            @slot('active') Apply Leave  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Name','Type','From','To','Apply Date','Status','Action']
        ])
            @slot('table_id') apply-list @endslot
        @endcomponent
        <!--login form Modal -->
        <div class="modal fade text-left" id="view-applyLeave" tabindex="-1" role="dialog"
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
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#apply-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "apply-leave",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'staff', name: 'staff'},
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