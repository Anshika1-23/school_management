@extends('student.layout')
@section('title','Homework List')
@section('content')
<div id="app">
    <div id="main" class="layout-horizontal">
        @include('student/components/top-header')
        <div class="content-wrapper container">
            <div class="page-heading">
                <h3 class="d-inline">Homework List</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <!-- show data table component -->
                    @component('admin.components.data-table',['thead'=>
                        ['S NO.','Subject','Marks','Homework Date','Submission Date','Action']
                    ])
                        @slot('table_id') homework-list @endslot
                    @endcomponent
                </section>
            </div>
        </div>
    </div>
</div>
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#homework-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "homework",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'subject', name: 'subject'},
            {data: 'marks', name: 'marks'},
            {data: 'homework_date', name: 'homework_date'},
            {data: 'submission_date', name: 'submission_date'},
            {data: 'action', name: 'action'},
        ]
    });
</script>
@stop


