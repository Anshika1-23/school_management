<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Data Table-->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/table-datatable-jquery.css')}}">
<!-- <link rel="stylesheet" href="./assets/compiled/css/table-datatable-jquery.css"> -->
<!-- App Css-->
<link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/app-dark.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/iconly.css')}}">
<!-- Sweetalert Css-->
<link rel="stylesheet" href="{{asset('assets/css/sweetalert2.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 

<style>
    .page-content{
        min-height: calc(100vh - 202px);
    }
    label.error{ color:#ff3f34 !important; }
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