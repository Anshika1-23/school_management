@extends('admin.layout')
@section('title','Guardian Report')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Guardian Report @endslot
            @slot('add_btn')  @endslot
            @slot('active') Guardian Report @endslot
        @endcomponent
        <!-- /.content-header -->
         <!-- // Basic multiple Column Form section start -->
         <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-5 col-6">
                                            <div class="form-group">
                                                <label class="form-label">Class Name</label>
                                                <select class="form-select class-select std-class" name="class_id" id="basicSelect">
                                                    <option value="" selected disabled>Select Class Name</option>
                                                    @if(!empty($class))
                                                        @foreach($class as $types)
                                                            <option value="{{$types->id}}" data-sections="{{$types->sections}}">{{$types->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Section Name</label>
                                                <select class="form-select section-select class-section" name="section_id" id="basicSelect">
                                                    <option disabled selected value="" >First Select Class Name</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 mt-4">
                                            <button type="button" class="btn btn-primary guardian-report"> Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="report-table" style="display:none;">
                    <div class="col-12">
                        <!-- show data table component -->
                        @component('admin.components.data-table',['thead'=>
                            ['S NO.','Admission No','Class','Student Name','Guardian Name','Mobile','Action']
                        ])
                            @slot('table_id') guaridan-list @endslot
                        @endcomponent
                        <!--edit student category form Modal -->
                        <div class="modal fade text-left" id="modal-info" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">View Details </h4>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="modal-body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @stop
                        @section('pageJsScripts')
                        <script type="text/javascript">
                            var table = $("#guaridan-list").DataTable({
                                ajax: {
                                    url: 'guardian-report',
                                    data: function(d){
                                        d.class = $('.std-class option:selected').val();
                                        d.section = $('.class-section').val();
                                    }
                                },
                                processing: true,
                                serverSide: true,
                                columns: [
                                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                    {data: 'admission_no', name: 'admission_no'},
                                    {data: 'class', name: 'class_id'},
                                    {data: 'full_name', name: 'first_name'},
                                    {data: 'parent', name: 'parent_id'},
                                    {data: 'parent_phone', name: 'phone'},
                                    {
                                        data: 'action',
                                        name: 'action',
                                        orderable: true,
                                        searchable: true,
                                    
                                    }
                                ]
                            });

                            $(".guardian-report").click(function() {
                                $(".report-table").css("display", "block");
                                $("#guaridan-list").css("width", "100%");
                                $('#guaridan-list').DataTable().ajax.reload();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </section>
        @stop
       