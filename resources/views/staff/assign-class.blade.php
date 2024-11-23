@extends('staff.layout')
@section('title','Assigned Classes')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index']])
            @slot('title') Assigned Classes @endslot
            @slot('add_btn') @endslot
            @slot('active') Assigned Classes @endslot
        @endcomponent
        <!-- /.content-header -->
          <!-- show data table component -->
          @component('admin.components.data-table',['thead'=>
            ['S NO.','Class','Section']
        ])
            @slot('table_id') assign-list @endslot
        @endcomponent
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#assign-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "assign-class",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'class', name: 'stdclass'},
                    {data: 'section', name: 'section'},
                ]
            });
        </script>
        @stop


