<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <div>
                <h3 class="d-inline">{{$title}}</h3>
                <span>{{$add_btn}}</span>
            </div>
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    @foreach($breadcrumb as $key => $value)
                        <li class="breadcrumb-item"><a href="{{url($value)}}">{{$key}}</a></li>
                    @endforeach
                    <li class="breadcrumb-item active">{{$active}}</li>
                </ol>
            </nav>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <a href="{{url('staff/logout')}}" class="float-start float-lg-end">LogOut</a>
        </div>
    </div>
</div>