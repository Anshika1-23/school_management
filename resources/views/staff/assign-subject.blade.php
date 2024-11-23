@extends('staff.layout')
@section('title','Assigned Subjects')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index']])
            @slot('title') Assigned Subjects @endslot
            @slot('add_btn') @endslot
            @slot('active') Assigned Subjects @endslot
        @endcomponent
        <!-- /.content-header -->
          <!-- show data table component -->
          @component('admin.components.data-table',['thead'=>
            ['S NO.','Subject','Class','Section']
        ])
            @slot('table_id') subject-list @endslot
        @endcomponent
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#subject-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "assigned-subjects",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'subject', name: 'subject'},
                    {data: 'class', name: 'stdclass'},
                    {data: 'section', name: 'section'},
                ]
            });
        </script>
        @stop


