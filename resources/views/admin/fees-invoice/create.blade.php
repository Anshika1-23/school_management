@extends('admin.layout')
@section('title','Add Fees Invoice')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Fees Invoice'=>'admin/fees-invoice-list']])
            @slot('title') Add Fees Invoice @endslot
            @slot('add_btn') @endslot
            @slot('active') Add Fees Invoice  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="addFeesInvoice" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Class Name</label>
                                                <select class="form-select class-select" name="class">
                                                    <option value="" selected disabled>Select Class Name</option>
                                                    @if(!empty($class))
                                                        @foreach($class as $cls)
                                                            <option value="{{$cls->id}}">{{$cls->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Section Name</label>
                                                <select class="form-select section-select" name="section">
                                                    <option disabled selected value="" >First Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Student</label>
                                                <select class="form-select student-select" name="student">
                                                    <option value="" selected disabled>First Select Section</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Fees Type </label>
                                                <select name="type" class="form-select invoice-fees-type">
                                                <option value="" selected disabled>Select Type</option>
                                                <option value="" disabled>FEES GROUPS</option>    
                                                @foreach($groups as $group)
                                                    <option value="grp{{$group->id}}">{{$group->title}}</option>
                                                @endforeach
                                                <option value="" disabled>FEES TYPES</option>    
                                                @foreach($types as $type)
                                                    <option value="typ{{$type->id}}">{{$type->title}}</option>
                                                @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Due Date </label>
                                                <input type="date" class="form-control" name="due_date" value="{{date('Y-m-d')}}" data-parsley-required="true"/> 
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="types-box">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Status </label>
                                                <select name="status" class="form-control invoice-status">
                                                    <option value="" selected disabled>Select Status</option>
                                                    <option value="1">Paid</option>
                                                    <option value="0">Not Paid</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-none pay-method">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Payment Method </label>
                                                <select name="pay_method" class="form-control">
                                                    <option value="" selected disabled>Payment Method</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="bank">Bank</option>
                                                    <option value="cheque">Cheque</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <button type="submit" class="btn btn-primary"> Submit </button>
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
