@extends('admin.layout')
@section('title','Approve Leave Request')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Approve Leave Request @endslot
            @slot('add_btn') @endslot
            @slot('active') Approve Leave Request  @endslot
        @endcomponent
        <!-- /.content-header -->
          <!-- show data table component -->
          @component('admin.components.data-table',['thead'=>
            ['S NO.','Name','Type','From','To','Apply Date','Status','Action']
        ])
            @slot('table_id') approve-list @endslot
        @endcomponent
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#approve-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "approve-leave",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'name', name: 'name'},
                    {data: 'type', name: 'type'},
                    {data: 'from', name: 'from'},
                    {data: 'to', name: 'to'},
                    {data: 'apply_date', name: 'apply_date'},
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


