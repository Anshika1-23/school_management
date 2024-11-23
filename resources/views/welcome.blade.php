<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School Management System</title>
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
</head>
<body class="text-center py-5">
    <img src="{{asset('assets/images/logo.png')}}" alt="" width="100px" class="mb-3">
    <h1 class="mb-5">School Management System</h1>
    <ul class="list-unstyled d-flex justify-content-center">
        <li class="me-2"><a href="{{url('admin')}}" class="btn btn-primary">Admin Login</a></li>
        <li class="me-2"><a href="{{url('staff/login')}}" class="btn btn-primary">Staff Login</a></li>
        <li class="me-2"><a href="{{url('student/login')}}" class="btn btn-primary">Student Login</a></li>
        <li class="me-2"><a href="{{url('parent/login')}}" class="btn btn-primary">Parent Login</a></li>
    </ul>
</body>
</html>