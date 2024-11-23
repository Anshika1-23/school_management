@extends('admin.layout')
@section('title','View Fees Invoice')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Fees Invoice'=>'admin/fees-invoice-list']])
            @slot('title') View Fees Invoice @endslot
            @slot('add_btn') @endslot
            @slot('active') View Fees Invoice  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Student Name</td>
                                                <th>{{$invoice->student_details->full_name}}</th>
                                            </tr>
                                            <tr>
                                                <td>Class (Section)</td>
                                                <th>{{$invoice->class_name->title}} ({{$invoice->section_name->title}})</th>
                                            </tr>
                                            <tr>
                                                <td>Roll No.</td>
                                                <th>{{$invoice->student_details->roll_no}}</th>
                                            </tr>
                                            <tr>
                                                <td>Admission No.</td>
                                                <th>{{$invoice->student_details->admission_no}}</th>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Invoice Number</td>
                                                <th>{{$invoice->id}}</th>
                                            </tr>
                                            <tr>
                                                <td>Create Date</td>
                                                <th>{{date('d M, Y',strtotime($invoice->created_at))}}</th>
                                            </tr>
                                            <tr>
                                                <td>Due Date</td>
                                                <th>{{date('d M, Y',strtotime($invoice->due_date))}}</th>
                                            </tr>
                                            <tr>
                                                <td>Payment Status</td>
                                                <th>
                                                    @if($invoice->status == '1')
                                                    Paid
                                                    @else
                                                    Unpaid
                                                    @endif
                                                </th>
                                            </tr>
                                            @if($invoice->status == '1')
                                            <tr>
                                                <td>Payment Date</td>
                                                <th>{{date('d M, Y',strtotime($invoice->payment_date))}}</th>
                                            </tr>
                                            <tr>
                                                <td>Payment Method</td>
                                                <th>{{$invoice->pay_method}}</th>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Fees Type</th>
                                                    <th>Amount</th>
                                                    <th>Waiver</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{$invoice->type_name->title}}</td>
                                                    <td>{{$invoice->amount}}</td>
                                                    <td>{{$invoice->waiver}}</td>
                                                    <td>{{$invoice->amount-$invoice->waiver}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @stop
        @section('pageJsScripts')
        <script>
            $(function(){
                $('.invoice-status').change(function(){
                    if($(this).val() == '1'){
                        $('.pay-method').removeClass('d-none');
                    }else{
                        $('.pay-method').addClass('d-none');
                    }
                });

                $(document).on('change','.amount',function(){
                    var amt = $(this).val();
                    var waiver = $(this).parent('td').siblings().children('.waiver').val();
                    if(waiver == '' || waiver == amt){
                        waiver = 0;
                    }
                    
                    var total = amt-waiver;
                    $(this).parent('td').siblings().children('.waiver').val(waiver);
                    $(this).parent('td').siblings().children('.t-amount').html(total);
                });

                $(document).on('change','.waiver',function(){
                    var waiver = $(this).val();
                    var amt = $(this).parent('td').siblings().children('.amount').val();
                    if(amt != ''){
                        var total = amt-waiver;
                        if(total < 1){
                            $(this).val('0');
                            $(this).parent('td').siblings().children('.t-amount').html(amt);
                        }else{
                            $(this).parent('td').siblings().children('.t-amount').html(total);
                        }
                    }
                });


                $(document).on('click','.remove-type',function(){
                    $(this).parent().parent().remove();
                    if($('.type-table tbody tr').length == '0'){
                        $('.invoice-fees-type').val('');
                        $('.types-box').empty();
                    }
                });
            });
        </script>
        @endsection
