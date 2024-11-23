@extends('admin.layout')
@section('title','Parent Detail')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Parent Detail @endslot
    @slot('add_btn') <a href="{{url('admin/parents/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Parent Detail  @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table component -->
@component('admin.components.data-table',['thead'=>
    ['S NO.','Father Name','Mother Name','Guardian Name','Action']
])
    @slot('table_id') parent-list @endslot
@endcomponent
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#parent-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "parents",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'father_name', name: 'father_name'},
            {data: 'mother_name', name: 'mother_name'},
            {data: 'guardian_name', name: 'guardian_name'},
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