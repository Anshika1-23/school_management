@extends('admin.layout')
@section('title','Notice List')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Notice List @endslot
            @slot('add_btn') <a href="{{url('admin/notice-list/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Notice List  @endslot
        @endcomponent
        <!-- /.content-header -->
        <div class="page-content">
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Title','Date','Action']
        ])
            @slot('table_id') notice-list @endslot
        @endcomponent
        </div>
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#notice-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "notice-list",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'title', name: 'title'},
                    {data: 'notice_date', name: 'date'},
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