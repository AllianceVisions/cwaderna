@extends('layouts.frontend') 
@section('content') 

@section('styles')
@parent 
    <!------------------form------------------->
    <!-- Icons font CSS-->
    <link href="{{asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('css/main.css')}}" rel="stylesheet" media="all">

    <!------------------form------------------->
@endsection 

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#"> دخول المستخدمين</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">دخول المستخدمين</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<div class="about">
    <div class="container">  
        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        @if(session('message'))
            <div class="alert alert-info" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}"> 
            @csrf
            <div class="col-6" style="margin: 0 auto;"> 
                <div class="row row-space">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="label">البريد الألكتروني</label>
                            <input id="email" type="email" class="input--style-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @if($errors->has('email'))
                                <div class="text-danger" style="font-weight: bolder">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group">
                            <label class="label">كلمة المرور</label>
                            <input id="password" type="password" class="input--style-4 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @if($errors->has('password'))
                                <div class="text-danger" style="font-weight: bolder">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div> 
                </div>
                
                
                <div style="text-align: center;"> 
                    <div class="p-t-15">
                        <button type="submit" class="contact-one__btn thm-btn">تسجبل الدخول</button> 
                    </div>
                    <a href="{{ route('password.request') }}" class="btn-link forgot-password"> نسيت كلمة المرور </a>
                </div>
            </div> 
        </form> 
    </div> 
</div> 
@endsection

@section('scripts')
@parent 
<!-- Jquery JS-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<!-- Vendor JS-->
<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
<script src="{{asset('vendor/datepicker/moment.min.js')}}"></script>
<script src="{{asset('vendor/datepicker/daterangepicker.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('js/global.js')}}"></script>
@endsection
