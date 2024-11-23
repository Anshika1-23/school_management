@extends('admin.layout')
@section('title','Subject')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Subject @endslot
    @slot('add_btn') <a href="{{url('admin/subjects/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Subject  @endslot
@endcomponent
<!-- /.content-header -->
<div class="page-content">
<!-- show data table component -->
@component('admin.components.data-table',['thead'=>
    ['S NO.','Subject','Subject Type','Status','Action']
])
    @slot('table_id') subject-list @endslot
@endcomponent
</div>
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#subject-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "subjects",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'subject'},
            {data: 'title_type', name: 'type'},
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