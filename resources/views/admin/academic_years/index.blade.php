@extends('admin.layout')
@section('title','Academic Years')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Academic Years @endslot
    @slot('add_btn') <a href="{{url('admin/academic_years/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Academic Years  @endslot
@endcomponent
<!-- /.content-header -->
<div class="page-content">
<!-- show data table component -->
@component('admin.components.data-table',['thead'=>
    ['S NO.','Title','Year','Start Date','End Date','Status','Action']
])
    @slot('table_id') year-list @endslot
@endcomponent
</div>
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#year-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "academic_years",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'title'},
            {data: 'year', name: 'year'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
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