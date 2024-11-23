@extends('admin.layout')
@section('title','Pay Payroll')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Payroll'=>'admin/staff-payroll']])
            @slot('title') Proceed to Pay @endslot
            @slot('add_btn')  @endslot
            @slot('active') Proceed to Pay @endslot
        @endcomponent
        <!-- /.content-header -->
         <!-- // Basic multiple Column Form section start -->
         <section id="multiple-column-form">
            
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="payPayrollAmount" class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Staff Name (Staff ID)</label>
                                            <input type="text" class="form-control" value="{{$payroll->staff_name->f_name}} {{$payroll->staff_name->l_name}} ( {{$payroll->staff_name->id}} )" readonly>
                                            <input type="text" hidden name="staff_id" value="{{$payroll->staff_name->id}}">
                                            <input type="text" class="id" hidden name="id" value="{{$payroll->id}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Month</label>
                                            <input type="text" class="form-control" value="{{$payroll->month}}" readonly>
                                            <input type="text" hidden name="month" value="{{$payroll->month}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Year</label>
                                            <input type="text" class="form-control" value="{{$payroll->year}}" readonly>
                                            <input type="text" hidden name="year" value="{{$payroll->year}}">
                                        </div>
                                    </div>
                                    @php 
                                    $earnings = 0;
                                    if(is_array($payroll->earnings)){
                                        $earn_array = json_decode($payroll->earnings);
                                        foreach($earn_array as $earn){
                                            $earnings += $earn->val;
                                        }
                                    }
                                    $deductions = 0;
                                    if(is_array($payroll->deductions)){
                                        $deduct_array = json_decode($payroll->deductions);
                                        foreach($deduct_array as $deduct){
                                            $deductions += $deduct->val;
                                        }
                                    }
                                    $salary = $payroll->basic_salary+($earnings-$deductions);
                                    $net_salary = $salary-$payroll->tax;
                                    @endphp
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Amount</label>
                                            <input type="number" class="form-control"  value="{{$net_salary}}" readonly >
                                            <input type="text" name="amount" value="{{$net_salary}}" hidden />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Payment Method</label>
                                            <select name="pay_method" class="form-select">
                                                <option value="" disabled selected>Select Method</option>
                                                <option value="cash">Cash</option>
                                                <option value="cheque">Cheque</option>
                                                <option value="bank">Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea name="note" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" class="btn btn-primary w-auto" value="Save" />   
                                    </div>
                            </form>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @stop
       
       