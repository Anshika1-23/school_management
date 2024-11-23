@extends('admin.layout')
@section('title','Generate Payroll')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Payroll'=>'admin/staff-payroll']])
            @slot('title') Generate Payroll @endslot
            @slot('add_btn')  @endslot
            @slot('active') Generate Payroll @endslot
        @endcomponent
        <!-- /.content-header -->
         <!-- // Basic multiple Column Form section start -->
         <section id="multiple-column-form">
            <form id="createPayroll">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Name</td>
                                            <th>{{$staff->f_name}} {{$staff->l_name}}</th>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <th>{{$staff->mobile}}</th>
                                        </tr>
                                        <tr>
                                            <td>Role</td>
                                            <th>{{$staff->role_name->title}}</th>
                                        </tr>
                                        <tr>
                                            <td>Designation</td>
                                            <th>{{$staff->designation_name && $staff->designation_name->title}}</th>
                                        </tr>
                                    </table>
                                </div>                                
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Email</td>
                                            <th>{{$staff->email}}</th>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <th>{{$staff->department_name && $staff->department_name->title}}</th>
                                        </tr>
                                        <tr>
                                            <td>Date of Joining</td>
                                            <th>{{date('d M, Y',strtotime($staff->date_of_joining))}}</th>
                                        </tr>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title">Earnings</h5>
                            <button type="button" class="btn btn-primary btn-sm add-earn-row">+ Add</button>
                        </div>
                        <div class="card-body earning-body">
                            <div class="earn-row row mb-2">
                                <input type="text" class="form-control me-1" name="earn[0][type]" placeholder="Type" style="width: 50%;" >
                                <input type="number" class="form-control me-1 val" name="earn[0][val]" placeholder="Value" style="width:30%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title">Deductions</h5>
                            <button type="button" class="btn btn-primary btn-sm add-deduct-row">+ Add</button>
                        </div>
                        <div class="card-body deduction-body">
                            <div class="deduct-row row mb-2">
                                <input type="text" class="form-control me-1" name="deduct[0][type]" placeholder="Type" style="width: 50%;" >
                                <input type="number" class="form-control me-1 val" name="deduct[0][val]"  placeholder="Value" style="width:30%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title">Payroll Summary</h5>
                            <button type="button" class="btn btn-primary btn-sm calculate">Calculate</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Basic Salary</td>
                                    <th>{{$staff->salary}}
                                    <input type="text" hidden class="basic-salary" name="basic_salary" value="{{$staff->salary}}"/>
                                    <input type="text" hidden  name="staff_id" value="{{$staff->id}}"/>
                                    <input type="text" hidden  name="month" value="{{$month}}"/>
                                    <input type="text" hidden  name="year" value="{{$year}}"/>
                                </th>
                                </tr>
                                <tr>
                                    <td>Earnings</td>
                                    <th><span class="total-earnings"></span><input type="text" class="earnings" name="earnings" hidden/></th>
                                </tr>
                                <tr>
                                    <td>Deductions</td>
                                    <th><span class="total-deductions"></span><input type="text" class="deductions" name="deductions" hidden/></th>
                                </tr>
                                <tr>
                                    <td>Gross Salary</td>
                                    <th><span class="gross-salary"></span></th>
                                </tr>
                                <tr>
                                    <td>Tax</td>
                                    <th><input type="number" name="tax" class="form-control tax" value="0"/></th>
                                </tr>
                                <tr>
                                    <td>Net Salary</td>
                                    <th><span class="net-salary"></span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <input type="submit" class="btn btn-primary" value="Save" />
                </div>
            </div>
            </form>
        </section>
        @stop
        @section('pageJsScripts')
        <script>
            $(function(){
            
            
            $('.add-earn-row').click(function(){
                var length = $('.earn-row').length;
                var earn = `<div class="earn-row row mb-2">
                                <input type="text" class="form-control me-1" name="earn[`+(length)+`][type]" placeholder="Type" style="width: 50%;" required >
                                <input type="number" class="form-control val me-1" name="earn[`+(length)+`][val]" placeholder="Value" style="width:30%;" required>
                                <button class="btn btn-danger btn-sm inline-block remove-earn-row" style="width:30px">x</button>
                            </div>`;
                $('.earning-body').append(earn);
            });

            $('.add-deduct-row').click(function(){
                var length = $('.deduct-row').length;
                var deduct = `<div class="deduct-row row mb-2">
                                <input type="text" class="form-control me-1" name="deduct[`+(length)+`][type]" placeholder="Type" style="width: 50%;" required >
                                <input type="number" class="form-control val me-1" name="deduct[`+(length)+`][val]" placeholder="Value" style="width:30%;" required>
                                <button class="btn btn-danger btn-sm inline-block remove-deduct-row" style="width:30px">x</button>
                            </div>`;
                $('.deduction-body').append(deduct);
            });

            $(document).on('click','.remove-earn-row',function(){
                $(this).parent().remove();
            });
            $(document).on('click','.remove-deduct-row',function(){
                $(this).parent().remove();
            });

            function calculate_earnings(){
                var total = 0;
                $('.earn-row').each(function(){
                    if($(this).children('.val').val() != ''){
                        total += parseInt($(this).children('.val').val());
                    }
                });
                $('.earnings').val(total);
                return total;
            }

            function calculate_deductions(){
                var total = 0;
                $('.deduct-row').each(function(){
                    if($(this).children('.val').val() != ''){
                        total += parseInt($(this).children('.val').val());
                    }
                });
                $('.deductions').val(total);
                return total;
            }
            
            function calculate(){
                var basic = $('.basic-salary').val();
                var earning = calculate_earnings();
                var deduction = calculate_deductions();
                var gross = basic+(earning-deduction);
                var tax = $('.tax').val();
                $('.total-earnings').html(earning);
                $('.total-deductions').html(deduction);
                $('.gross-salary').html(gross);
                $('.net-salary').html(gross-tax);
            }
            
            calculate();

            $('.calculate').click(function(){
                calculate();
            });


            });
        </script>
        @endsection
       