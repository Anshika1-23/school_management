<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <!-- App Css-->
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/iconly.css')}}">
    <!-- Sweetalert Css-->
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.min.css')}}">
    <style>
        .preloader{
            background-color: rgba(255,255,255,0.3);
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
        }

        .preloader img{
            transform: translateX(-50%) translateY(-50%);
            position: absolute;
            left: 50%;
            top: 50%;
        }
    </style>
   </head>
<body>
    <div class="my-5">
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height me-0">
                <div class="col-lg-4 mx-auto">
                    <div class="card">
                        <div class="card-header text-center">
                            <img src="{{asset('assets/images/logo.png')}}" height="85px" alt="Logo" srcset="">
                        </div>
                        <h4 class="text-center">STUDENT LOGIN</h4>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="studentLogin" class="position-relative" method="POST">
                                    @csrf
                                    <!-- <input type="hidden" class="url" value="{{url('staff')}}"> -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" placeholder="Email" data-parsley-required="true"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mandatory">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" data-parsley-required="true"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div class="col-12">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if(Session::has('loginError'))
                                            <div class="alert alert-danger">
                                                {{Session::get('loginError')}}
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- // Basic multiple Column Form section end -->
    <script src="{{asset('assets/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/js/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <!-- jquery-validation Js-->
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/student-login.js')}}"></script>
    <input type="hidden" class="std-url" value="{{url('student')}}">
</body>
</html>