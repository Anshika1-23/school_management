@extends('admin.layout')
@section('title','Holiday List')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Holiday List @endslot
            @slot('add_btn') <a href="{{url('admin/holiday/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Holiday List  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Title','From Date','To Date','Action']
        ])
            @slot('table_id') holiday-list @endslot
        @endcomponent
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#holiday-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "holiday",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'title', name: 'title'},
                    {data: 'from_date', name: 'from_date'},
                    {data: 'to_date', name: 'to_date'},
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