@extends('admin.layout')
@section('title','Staff')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Staff @endslot
    @slot('add_btn') <a href="{{url('admin/staffs/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Staff  @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table component -->
@component('admin.components.data-table',['thead'=>
    ['S NO.','Name','Role','Department','Designation','Status','Action']
])
    @slot('table_id') staff-list @endslot
@endcomponent
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#staff-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "staffs",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'full_name', name: 'full_name'},
            {data: 'role_title', name: 'role_title'},
            {data: 'department_title', name: 'department_title'},
            {data: 'designation_title', name: 'designation_title'},
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