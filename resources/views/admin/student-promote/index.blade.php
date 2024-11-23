@extends('admin.layout')
@section('title','Student Promote')
@section('content')
<div id="app">
    <div id="main">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Student Promote @endslot
            @slot('add_btn')  @endslot
            @slot('active') Student Promote @endslot
        @endcomponent
        <!-- /.content-header -->
         <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Select Criteria
                            </h5>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST" id="showPromotionTable">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Academic Year</label>
                                                <select class="form-select select-role" name="from_year">
                                                    <option value="" selected disabled>Select Year</option>
                                                    @if(!empty($academic_year))
                                                        @foreach($academic_year as $from)
                                                            <option value="{{$from->id}}">{{$from->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Promote Academic Year</label>
                                                <select class="form-select select-role" name="to_year">
                                                    <option value="" selected disabled>Select Year</option>
                                                    @if(!empty($academic_year))
                                                        @foreach($academic_year as $to)
                                                            <option value="{{$to->id}}">{{$to->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Class</label>
                                                <select class="form-select class-select" name="class">
                                                    <option value="" selected disabled>Select Class</option>
                                                    @if(!empty($classes))
                                                        @foreach($classes as $class)
                                                            <option value="{{$class->id}}">{{$class->title}}</option>
                                                        @endforeach
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Section</label>
                                                <select class="form-select section-select" name="section">
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
                    <div class="promote-box position-relative">
                        
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
        $(document).on('click','.check-all',function(){
            if($(this).prop('checked') == true){
                $('.promote-box table tbody input[type=checkbox]').prop('checked',true);
            }else{
                $('.promote-box table tbody input[type=checkbox]').prop('checked',false);
            }
        });
    });
</script>
@endsection
       