@extends('admin.layout')
@section('title','Session')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Session @endslot
    @slot('add_btn') <a href="{{url('admin/sessions/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Session  @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table component -->
@component('admin.components.data-table',['thead'=>
    ['S NO.','Session','Start Date','End Date','Status','Action']
])
    @slot('table_id') session-list @endslot
@endcomponent
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#session-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "sessions",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'session'},
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