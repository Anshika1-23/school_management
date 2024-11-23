@extends('student.layout')
@section('title','Fees Invoice')
@section('content')
<div id="app">
    <div id="main" class="layout-horizontal">
        @include('student/components/top-header')
        <div class="content-wrapper container">
            <div class="page-heading">
                <h3 class="d-inline">Fees Invoice</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <!-- show data table component -->
                    @component('admin.components.data-table',['thead'=>
                        ['S NO.','Student','Class(Section)','Type','Amount','Waiver','Status']
                    ])
                        @slot('table_id') fees-list @endslot
                    @endcomponent
                </section>
            </div>
        </div>
    </div>
</div>
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#fees-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "fees",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'student_full_name', name: 'student_full_name'},
            {data: 'class_section', name: 'class_section'},
            {data: 'fees_type', name: 'fees_type'},
            {data: 'amount', name: 'amount'},
            {data: 'waiver', name: 'waiver'},
            {data: 'fees_status', name: 'fees_status'},
        ]
    });
</script>
@stop


