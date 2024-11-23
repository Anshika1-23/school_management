@extends('admin.layout')
@section('title','Class')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Class @endslot
    @slot('add_btn') <a href="{{url('admin/classes/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Class  @endslot
@endcomponent
<!-- /.content-header -->
<div class="page-content">
    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
    ['S NO.','Class','Section','Status','Action']
    ])
    @slot('table_id') stdClass-list @endslot
    @endcomponent
</div>

@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#stdClass-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "classes",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'class'},
            {data: 'section_list', name: 'section'},
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