@extends('parent.layout')
@section('title','Fees')
@section('content')
<div id="app">
    <div id="main" class="layout-horizontal">
        @include('parent/components/top-header')
        <div class="content-wrapper container">
            <div class="page-heading">
                <h3>{{$student->full_name}} Fees</h3>
            </div>
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fees Type</th>
                                    <th>Amount</th>
                                    <th>Waiver</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($invoice->isNotEmpty())
                                @foreach($invoice as $row)
                                <tr>
                                    <td>{{$row->type_name->title}} ({{$row->group_name->title}})</td>
                                    <td>{{$row->amount}}</td>
                                    <td>{{$row->waiver}}</td>
                                    <td>{{$row->status == '1' ? 'Paid' : 'Not Paid'}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4">No Fees Found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@stop   