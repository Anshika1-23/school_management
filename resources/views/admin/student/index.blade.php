@extends('admin.layout')
@section('title','Student')
@section('content')
<div id="app">
    <div id="main">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Student @endslot
    @slot('add_btn') <a href="{{url('admin/students/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
    @slot('active') Student  @endslot
@endcomponent
<!-- /.content-header -->
<div class="page-content">
<!-- show data table component -->
@component('admin.components.data-table',['thead'=>
    ['S NO.','Admission No','Name','Class','Section','Gender','Status','Action']
])
    @slot('table_id') student-list @endslot
@endcomponent
</div>
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#student-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "students",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'admission_no', name: 'admission_no'},
            {data: 'full_name', name: 'username'},
            {data: 'class_title', name: 'class_title'},
            {data: 'section_title', name: 'section_title'},
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