@extends('admin.layout')
@section('title','Pending Leave Request')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Pending Leave Request @endslot
            @slot('add_btn') @endslot
            @slot('active') Pending Leave Request  @endslot
        @endcomponent
        <!-- /.content-header -->
          <!-- show data table component -->
          @component('admin.components.data-table',['thead'=>
            ['S NO.','Name','Type','From','To','Apply Date','Status','Action']
        ])
            @slot('table_id') pending-list @endslot
        @endcomponent
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#pending-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "pending-leave",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                   // {data: 'staff', name: 'staff_id'},
                   {data: 'staff_id', name: 'staff_id'},
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


