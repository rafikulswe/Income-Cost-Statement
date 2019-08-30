<?php
// $link=explode('/',$_SERVER['PHP_SELF']);
// print_r($link);
// $_SERVER['PHP_SELF'];
// print $_SERVER["REQUEST_URI"];
// $page=(isset($link[3]))?$link[3]:'index';

$link=explode('/',$_SERVER['REQUEST_URI']);
$page=$link[count($link)-1];
// echo "$page";
$page=($page=='home')?'home':$page;
// echo $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{asset('public/contents/img/admin-favicon.png')}}">
        <link href="{{asset('public/contents/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('public/contents/css/animate.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('public/contents/css/dashboard.css')}}" rel="stylesheet"/>
        <link href="{{asset('public/contents/css/demo.css')}}" rel="stylesheet" />
        <link href="{{asset('public/contents/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href='{{asset('public/contents/css/google.fonts.css')}}' rel='stylesheet' type='text/css'>
        <link href="{{asset('public/contents/css/themify-icons.css')}}" rel="stylesheet">
        <link href="{{asset('public/contents/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <link href="{{asset('public/contents/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('public/contents/css/style.css')}}" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="danger">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            Khorcha
                        </a>
                    </div>
                    <ul class="nav">
                        <li @if($page=="dashboard") class="active" @endif>
                            <a href="{{route('dashboard')}}">
                                <i class="fa fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li @if($page=="manage") class="active" @endif>
                            <a href="{{route('manage')}}">
                                <i class="fa fa-gears"></i>
                                <p>Manage</p>
                            </a>
                        </li>
                        <li @if($page=="income") class="active" @endif>
                            <a href="{{route('income')}}">
                                <i class="ti-wallet"></i>
                                <p>Income</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{url('/admin/user')}}">
                                <i class="fa fa-user-circle-o"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/admin/summary')}}">
                                <i class="fa fa-gg-circle"></i>
                                <p>Summary</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{url('/admin/expense')}}">
                                <i class="fa fa-cubes"></i>
                                <p>Expense</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/admin/loan')}}">
                                <i class="fa fa-address-book-o"></i>
                                <p>Loan Information</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fa fa-cloud"></i>
                                <p>Report</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{url('/admin/recycle')}}">
                                <i class="fa fa-recycle"></i>
                                <p>Recycle Bin</p>
                            </a>
                        </li>
                        <li class="active-pro">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="@if($page=="home"){{route('home')}} @elseif($page=="dashboard"){{route('dashboard')}} @endif">
                                @if($page=="home")Welcome @elseif($page=="dashboard")Dashboard @elseif($page=="income") Income @elseif($page=="manage") Manage @elseif($page=="incomeCategory") Income Category @endif
                            </a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <p>{{ Auth::user()->name }}</p>
                                        <b class="fa fa-user-circle-o"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Profile</a></li>
                                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    </ul>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </nav>
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    <li>
                        @if($page=="home")Welcome @elseif($page=="dashboard")Dashboard @elseif($page=="income") Income @elseif($page=="manage") Manage @elseif($page=="incomeCategory") Income Category @endif
                    </li>
                </ul>

                @yield('content')

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright pull-right">
                            Copyright &copy; {{date('Y')}}. Development by <a href="#">Mr. Rafi</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
    <script src="{{asset('public/contents/js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/contents/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/contents/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('public/contents/js/dashboard.js')}}"></script>
    <script src="{{asset('public/contents/js/demo.js')}}"></script>
    <script src="{{asset('public/contents/js/dataTables.min.js')}}"></script>
    <script src="{{asset('public/contents/js/custom.js')}}"></script>
    <script src="{{ asset('public/authContents/validation/js/formValidation.min.js') }}"></script>

    @stack('javaScript')
    <script>
  $(document).ready(function(){
    $( "#search" ).click(function() {
      var from = $('#datepickerForm').val();
      var to = $('#datepickerTo').val();
      var base_url = window.location.origin;
      var url = base_url+'/admin/summary/search/'+from+'/'+to;
      location.href = url;
    });
  });
</script>
</html>
