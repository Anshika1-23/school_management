@extends('admin.layout')
@section('title','Student Document Info')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Student Document Info @endslot
    @slot('add_btn') <a href="{{url('admin/doc-info/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Document Info  @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table component -->
@component('admin.components.data-table',['thead'=>
    ['S NO.','Image','title','Action']
])
    @slot('table_id') documentInfo-list @endslot
@endcomponent
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#documentInfo-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "doc-info",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'image', name: 'image'},
            {data: 'title', name: 'title'},
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