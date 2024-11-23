@extends('admin.layout')
@section('title','Print Payroll')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Payroll'=>'admin/staff-payroll']])
            @slot('title') Print Payroll @endslot
            @slot('add_btn')  @endslot
            @slot('active') Print Payroll @endslot
        @endcomponent
        <!-- /.content-header -->
         <!-- // Basic multiple Column Form section start -->
         <section id="multiple-column-form">
            
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Name</td>
                                            <th>{{$payroll->staff_name->f_name}} {{$payroll->staff_name->l_name}}</th>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <th>{{$payroll->staff_name->mobile}}</th>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <th>{{$payroll->staff_name->email}}</th>
                                        </tr>
                                        <tr>
                                            <td>Role</td>
                                            <th>{{$payroll->staff_name->role_name->title}}</th>
                                        </tr>
                                        <tr>
                                            <td>Designation</td>
                                            <th>{{$payroll->staff_name->designation_name ? $payroll->staff_name->designation_name->title : ''}}</th>
                                        </tr>
                                    </table>
                                </div>                                
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        
                                        <tr>
                                            <td>Department</td>
                                            <th>{{$payroll->staff_name->department_name ? $payroll->staff_name->department_name->title : ''}}</th>
                                        </tr>
                                        <tr>
                                            <td>Date of Joining</td>
                                            <th>{{date('d M, Y',strtotime($payroll->staff_name->date_of_joining))}}</th>
                                        </tr>
                                        <tr>
                                            <td>Payment Date</td>
                                            <th>{{date('d M, Y',strtotime($payroll->payment->created_at))}}</th>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <th>{{$payroll->payment->method}}</th>
                                        </tr>
                                    </table>
                                </div> 
                                <div class="col-12">
                                    @php
                                    $earnings = 0;
                                    if(is_array($payroll->earnings)){
                                        $earn_array = json_decode($payroll->earnings);
                                        foreach($earn_array as $earn){
                                            $earnings += $earn->val;
                                        }
                                    }
                                    $deductions = 0;
                                    if($payroll->deductions){
                                        $deduct_array = json_decode($payroll->deductions);
                                        foreach($deduct_array as $deduct){
                                            $deductions += $deduct->val;
                                        }
                                    }
                                    $salary = $payroll->basic_salary+($earnings-$deductions);
                                    @endphp
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Basic Salary</td>
                                            <td>{{$payroll->basic_salary}}</td>
                                        </tr>
                                        <tr>
                                            <td>Earnings</td>
                                            <td>{{$earnings}}</td>
                                        </tr>
                                        <tr>
                                            <td>Deductions</td>
                                            <td>{{$deductions}}</td>
                                        </tr>
                                        <tr>
                                            <td>Gross Salary</td>
                                            <td>{{$salary}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tax</td>
                                            <td>{{$payroll->tax}}</td>
                                        </tr>
                                        <tr>
                                            <td>Net Salary</td>
                                            <td>{{$payroll->payment->amount}}</td>
                                        </tr>
                                    </table>
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @stop
        
       