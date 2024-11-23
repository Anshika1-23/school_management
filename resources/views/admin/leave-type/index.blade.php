@extends('admin.layout')
@section('title','Leave Type')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Leave Type @endslot
            @slot('add_btn') <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default"> Add New </button>@endslot
            @slot('active') Leave Type  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Leave Type','Status','Action']
        ])
            @slot('table_id') leave-list @endslot
        @endcomponent
        <!--login form Modal -->
        <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Add Leave Type </h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="addLeave" class="position-relative" method="POST">
                        
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title: </label>
                                <input type="text" placeholder="leave" name="title" class="form-control">
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
                        <h4 class="modal-title" id="myModalLabel33">Edit Leave Type </h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="editLeave" class="position-relative" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="modal-body">
                            <label>Leave Type: </label>
                            <div class="form-group">
                                <input type="text" placeholder="leave" name="title" class="form-control">
                                <input type="hidden" name="id" >
                            </div>
                            <label class="form-label"> Status </label>
                            <select class="form-select" name="status" id="basicSelect">
                                <option value="" selected disabled>Select Status</option>    
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
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
    var table = $("#leave-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "leaves",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'leave'},
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