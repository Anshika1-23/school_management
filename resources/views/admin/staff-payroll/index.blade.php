@extends('admin.layout')
@section('title','Staff Payroll')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Staff Payroll @endslot
            @slot('add_btn')  @endslot
            @slot('active') Staff Payroll @endslot
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
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Role</label>
                                                <select class="form-select role" name="role">
                                                    <option value="" selected disabled>Select Role</option>
                                                    @if(!empty($roles))
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Month</label>
                                                <select class="form-select month" name="month">
                                                    @for($m=1;$m<=12;$m++)
                                                    <option value="{{$m}}">{{date("F", mktime(0, 0, 0, $m, 1))}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Year</label>
                                                <select class="form-select year" name="year">
                                                    @php $y = date('Y'); @endphp
                                                    @for($i=$y;$i>($y-10);$i--)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2">
                                            <button type="button" class="btn btn-primary search-payroll"> Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payroll-table" style="display:none;">
                    <div class="col-12">
                        <!-- show data table component -->
                        @component('admin.components.data-table',['thead'=>
                            ['S NO.','Name','Role','Department','Mobile','Status','Action']
                        ])
                            @slot('table_id') payroll-list @endslot
                        @endcomponent
                        
                        @stop
                        @section('pageJsScripts')
                        <script type="text/javascript">
                            var table = $("#payroll-list").DataTable({
                                ajax: {
                                    url: 'staff-payroll',
                                    data: function(d){
                                        d.role = $('.role option:selected').val();
                                        d.month = $('.month option:selected').val();
                                        d.year = $('.year option:selected').val();
                                    }
                                },
                                processing: true,
                                serverSide: true,
                                columns: [
                                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                    {data: 'staff_name', name: 'name'},
                                    {data: 'role_title', name: 'role_title'},
                                    {data: 'department_title', name: 'department_title'},
                                    {data: 'mobile', name: 'mobile'},
                                    {data: 'status', name: 'status'},
                                    {
                                        data: 'action',
                                        name: 'action',
                                        orderable: true,
                                        searchable: true,
                                    
                                    }
                                ]
                            });

                            $(".search-payroll").click(function() {
                                $(".payroll-table").css("display", "block");
                                $("#payroll-list").css("width", "100%");
                                $('#payroll-list').DataTable().ajax.reload();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </section>
        @stop
       