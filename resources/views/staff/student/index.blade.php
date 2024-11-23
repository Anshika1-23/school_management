@extends('staff.layout')
@section('title','Student')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index']])
    @slot('title') Student @endslot
    @slot('add_btn') <a href="{{url('staff/students/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Student  @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table component -->
@component('staff.components.data-table',['thead'=>
    ['S NO.','UserName','Gender','Status','Action']
])
    @slot('table_id') student-list @endslot
@endcomponent
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#student-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "students",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'first_name', name: 'username'},
            {data: 'gender', name: 'gender'},
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