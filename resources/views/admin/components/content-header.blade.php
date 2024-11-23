<header class="mb-3 row">
    <div class="col-6">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </div>
    <div class="col-6 align-self-center">
        <a href="javascript:void(0)" class="float-end admin-logout ">LogOut</a>
    </div>
</header>
<div class="page-title">
    <div class="row">
        <div class="col-8">
            <h3 class="">{{$title}}</h3>
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    @foreach($breadcrumb as $key => $value)
                        <li class="breadcrumb-item"><a href="{{url($value)}}">{{$key}}</a></li>
                    @endforeach
                    <li class="breadcrumb-item active">{{$active}}</li>
                </ol>
            </nav>
        </div>
        <div class="col-4 text-end">
            <span>{{$add_btn}}</span>
        </div>
    </div>
</div>