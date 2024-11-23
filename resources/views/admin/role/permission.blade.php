@extends('admin.layout')
@section('title','Login Permission')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Login Permission @endslot
            @slot('add_btn')  @endslot
            @slot('active') Login Permission @endslot
        @endcomponent
        <!-- /.content-header -->
         <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST" id="showRecordPermission">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label">Role</label>
                                                <select class="form-select select-role" name="role">
                                                    <option value="" selected disabled>Select Role</option>
                                                    @if(!empty($roles))
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 student-class d-none">
                                            <div class="form-group">
                                                <label class="form-label">Class</label>
                                                <select class="form-select class-select" name="class" required>
                                                    <option value="" selected disabled>Select Class</option>
                                                    @if(!empty($classes))
                                                        @foreach($classes as $class)
                                                            <option value="{{$class->id}}">{{$class->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 student-section d-none">
                                            <div class="form-group">
                                                <label class="form-label">Section</label>
                                                <select class="form-select section-select" name="section" required>
                                                    <option value="" selected disabled>First Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary"> Search </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="result-card position-relative">
                        {{-- <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Students List</h5>
                                <button class="btn btn-success btn-sm mb-1"><i class="bi bi-check-circle"></i> Mark Permssion to All Students</button>
                                <button class="btn btn-danger btn-sm mb-1"><i class="bi bi-x-circle"></i> Remove Permssion From All Students</button>
                                <button class="btn btn-warning btn-sm mb-1"><i class="bi bi-arrow-clockwise"></i> Reset All Student Password</button>
                                <button class="btn btn-info btn-sm mb-1"><i class="bi bi-arrow-clockwise"></i> Reset All Parents Password</button>
                                <button class="btn btn-dark btn-sm mb-1"><i class="bi bi-check-circle"></i> Mark Permssion to All Parents</button>
                                <button class="btn btn-light btn-sm mb-1"><i class="bi bi-x-circle"></i> Remove Permssion From All Parents</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Admission No.</th>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Student Permission</th>
                                            <th>Student Password</th>
                                            <th>Parent Permission</th>
                                            <th>Parent Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>Name</td>
                                            <td>Class</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input permission-checkbox">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <input type="text" class="form-control me-1" name="password" />
                                                    <button type="button" class="btn btn-success btn-sm me-1  save-staff-password" title="Save"><i class="bi bi-floppy"></i></button>
                                                    <button type="button" class="btn btn-primary btn-sm reset-staff-password"  title="Reset"><i class="bi bi-arrow-clockwise"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input permission-checkbox">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <input type="text" class="form-control me-1" name="password" />
                                                    <button type="button" class="btn btn-success btn-sm me-1  save-staff-password" title="Save"><i class="bi bi-floppy"></i></button>
                                                    <button type="button" class="btn btn-primary btn-sm reset-staff-password"  title="Reset"><i class="bi bi-arrow-clockwise"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@stop
@section('pageJsScripts')
<script>
    $(function(){
        $('.select-role').change(function(){
            if($(this).val() == '2'){
                $('.student-class').removeClass('d-none');
                $('.student-section').removeClass('d-none');
            }else{
                $('.student-class').addClass('d-none');
                $('.student-section').addClass('d-none');
            }
        });
    });
</script>
@endsection
       