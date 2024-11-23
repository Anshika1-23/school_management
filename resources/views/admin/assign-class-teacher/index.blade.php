@extends('admin.layout')
@section('title','Assign Class Teacher')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Assign Class Teacher @endslot
    @slot('add_btn') <a href="{{url('admin/assign-class-teacher/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Assign Class Teacher  @endslot
@endcomponent
<!-- /.content-header -->
<div class="page-content">
<!-- show data table component -->
@component('admin.components.data-table',['thead'=>
    ['S NO.','Class','Section','Teacher','Status','Action']
])
    @slot('table_id') assignClass-list @endslot
@endcomponent
</div>
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#assignClass-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "assign-class-teacher",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'class', name: 'stdclass'},
            {data: 'section', name: 'section'},
            {data: 'staff', name: 'staff'},
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