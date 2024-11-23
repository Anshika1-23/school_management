@extends('admin.layout')
@section('title','HomeWork List')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') HomeWork List @endslot
            @slot('add_btn') <a href="{{url('admin/homework/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') HomeWork List  @endslot
        @endcomponent
        <!-- /.content-header -->
        <div class="page-content">
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Class','Section','Subject','Marks','Homework Date','Submission Date','Action']
        ])
            @slot('table_id') homework-list @endslot
        @endcomponent
        </div>
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#homework-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "homework",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'class', name: 'class_id'},
                    {data: 'section', name: 'section_id'},
                    {data: 'subject', name: 'subject_id'},
                    {data: 'marks', name: 'mark'},
                    {data: 'homework_date', name: 'homework_date'},
                    {data: 'submission_date', name: 'submission_date'},
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