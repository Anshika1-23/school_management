@extends('admin.layout')
@section('title','Leave Define')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Leave Define @endslot
            @slot('add_btn') <a href="{{url('admin/l-define/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Leave Define  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','UserName','Role','Leave Type','Days','Status','Action']
        ])
            @slot('table_id') define-list @endslot
        @endcomponent
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#define-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "l-define",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'username', name: 'username'},
                  //  {data: 'staff', name: 'username'},
                    {data: 'role', name: 'role'},
                    {data: 'leaveType', name: 'type'},
                    {data: 'days', name: 'days'},
                    {data: 'status', name: 'status'},
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