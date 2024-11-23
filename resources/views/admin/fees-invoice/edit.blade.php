@extends('admin.layout')
@section('title','Edit Fees Invoice')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Fees Invoice'=>'admin/fees-invoice-list']])
            @slot('title') Edit Fees Invoice @endslot
            @slot('add_btn') @endslot
            @slot('active') Edit Fees Invoice  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="updateFeesInvoice" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    {{method_field('PUT')}}
                                    <div class="row">
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Class Name</label>
                                                <input type="text" class="form-control" readonly value="{{$invoice->class_name->title}}">
                                                <input type="text" hidden value="{{$invoice->id}}" class="id"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Section Name</label>
                                                <input type="text" class="form-control" readonly value="{{$invoice->section_name->title}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Student</label>
                                                <input type="text" class="form-control" readonly value="{{$invoice->student_name->full_name}}({{$invoice->student_name->id}})">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Due Date </label>
                                                <input type="date" class="form-control" name="due_date" value="{{$invoice->due_date}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="types-box">
                                                <table class="table table-bordered type-table">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Fees Type</th>
                                                            <th>Amount</th>
                                                            <th>Waiver</th>
                                                            <th>Total Amount</th>
                                                            <th>Note</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>{{$invoice->type_name->title}}
                                                            </td>
                                                            <td><input type="number" name="amount" min="0" class="form-control amount" value="{{$invoice->amount}}" required></td>
                                                            <td><input type="number" name="waiver" min="0" class="form-control waiver" value="{{$invoice->waiver}}" ></td>
                                                            <td><span class="t-amount">{{$invoice->amount-$invoice->waiver}}</span></td>
                                                            <td><input type="text" name="note" class="form-control" value="{{$invoice->note}}"></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Status </label>
                                                <select name="status" class="form-control invoice-status">
                                                    <option value="" @if($invoice->status == '') selected @endif disabled>Select Status</option>
                                                    <option value="1" @if($invoice->status == '1') selected @endif>Paid</option>
                                                    <option value="0" @if($invoice->status == '0') selected @endif>Not Paid</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 @if($invoice->status == '0') d-none @endif pay-method">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Payment Method </label>
                                                <select name="pay_method" class="form-control">
                                                    <option value="" @if($invoice->pay_method == '') selected @endif selected disabled>Payment Method</option>
                                                    <option value="cash"  @if($invoice->pay_method == 'cash') selected @endif>Cash</option>
                                                    <option value="bank" @if($invoice->pay_method == 'bank') selected @endif>Bank</option>
                                                    <option value="cheque" @if($invoice->pay_method == 'cheque') selected @endif>Cheque</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <button type="submit" class="btn btn-primary"> Update </button>
                                        </div>
                                    </div>
                                </form>
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
