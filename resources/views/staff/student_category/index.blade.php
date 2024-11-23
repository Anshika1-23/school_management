@extends('staff.layout')
@section('title','Student Category')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('staff.components.content-header',['breadcrumb'=>['Dashboard'=>'staff/index']])
            @slot('title') Student Category @endslot
            @slot('add_btn') <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default"> Add New </button>@endslot
            @slot('active') Student Category  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('staff.components.data-table',['thead'=>
            ['S NO.','Title','Action']
        ])
            @slot('table_id') category-list @endslot
        @endcomponent
        <!--login form Modal -->
        <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Add Category </h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="addStudentCategory" method="POST">
                        @csrf
                        <div class="modal-body">
                            <label>Title: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Title" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <span class="d-none d-sm-block">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--login form Modal -->
        <div class="modal fade text-left" id="modal-info" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Category </h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="updateStudentCategory" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="modal-body">
                            <label>Title: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Title" name="title" class="form-control">
                                <input type="hidden" name="id" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <span class="d-none d-sm-block">Update</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@stop
@section('pageJsScripts')
<script type="text/javascript">
    var table = $("#category-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "student_category",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'section'},
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