@extends('admin.layout')
@section('title','Fees Group')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Fees Group @endslot
            @slot('add_btn') <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default"> Add New </button>@endslot
            @slot('active') Fees Group  @endslot
        @endcomponent
        <!-- /.content-header -->
        <div class="page-content">
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Title','Description','Action']
        ])
            @slot('table_id') group-list @endslot
        @endcomponent
        </div>
        <!--login form Modal -->
        <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Add Fees Group </h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="addFeesGroup" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title: </label>
                                <input type="text" placeholder="Title" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description: </label>
                                <textarea name="descr" class="form-control"></textarea>
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
                        <h4 class="modal-title" id="myModalLabel33">Edit Fees Group </h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="updateFeesGroup" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title: </label>
                                <input type="text" placeholder="Title" name="title" class="form-control">
                                <input type="hidden" name="id" >
                            </div>
                            <div class="form-group">
                                <label>Description: </label>
                                <textarea name="descr" class="form-control"></textarea>
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
    var table = $("#group-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "fees-group",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'section'},
            {data: 'descr', name: 'descr'},
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