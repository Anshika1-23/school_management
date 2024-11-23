@extends('admin.layout')
@section('title','Fees Invoice')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Fees Invoice List @endslot
            @slot('add_btn') <a href="{{url('admin/fees-invoice-list/create')}}" class="btn btn-sm btn-primary">Add New</a> @endslot
            @slot('active') Fees Invoice List  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        <div class="page-content">
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Student (Adm No.)','Amount','Waiver','Date','Status','Action']
        ])
            @slot('table_id') invoice-list @endslot
        @endcomponent
        </div>
        @stop
        @section('pageJsScripts')
        <script type="text/javascript">
            var table = $("#invoice-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "fees-invoice-list",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
                    {data: 'student_full_name', name: 'student_full_name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'waiver', name: 'waiver'},
                    {data: 'created_at', name: 'created_at'},
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