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
            <li class="active"><a href="#">مستخدم جديد </a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">تسجيل مزود خدمة</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>
<div class="about">
    <div class="container">  
        
        <div class="row mb-4">
            <div class="col-md-4">
                <a class="btn btn-outline-info text-dark" style="border-radius:30px" href="{{route('caders.register')}}">تسجيل ككادر</a>
            </div>
            <div class="col-md-4">
                <a class="btn btn-outline-danger text-dark" style="border-radius:30px" href="{{route('organizers.register')}}">تسجيل كمنظم فعاليات</a>
            </div>
            <div class="col-md-4"> 
                <a class="btn btn-outline-warning text-dark" style="border-radius:30px" href="{{route('services.register')}}">تسجيل كمزود خدمة</a>
            </div>
        </div>

        @if($errors->count() > 0) 
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{$error}} <br>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('services.register_submit') }}">
            @csrf
            <div class="row row-space"> <h4>بيانات المسؤول عن الحساب</h4></div>

            <div class="row row-space">
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">الاسم الاول</label>
                        <input class="input--style-4" type="text" name="first_name" required value="{{old('first_name')}}"> 
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">الاسم الاخير</label>
                        <input class="input--style-4" type="text" name="last_name" required value="{{old('last_name')}}"> 
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">النوع</label>
                        <div class="p-t-10">
                            <label class="radio-container m-r-45">ذكر
                                <input type="radio" checked="checked" value="male" name="gender">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-container">انثى
                                <input type="radio" value="female" name="gender">
                                <span class="checkmark"></span>
                            </label>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="row "> 
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">البريد الإلكتروني</label>
                        <input class="input--style-4" type="email" name="email" value="{{old('email')}}" required> 
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">كلمة السر</label>
                        <input class="input--style-4" type="password" name="password" value="{{old('password')}}"> 
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">رقم التليفون</label>
                        <input class="input--style-4" type="text" name="phone" required value="{{old('phone')}}"> 
                    </div>
                </div>
            </div>

            <div class="row ">   
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">رقم الهوية</label>
                        <input class="input--style-4" type="text" name="national_id" required value="{{old('national_id')}}"> 
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">الجنسية</label>
                        <div class="rs-select2 js-select-simple" style="width: 100%;">
                            <select name="nationality" required>
                                <option disabled="disabled" selected="selected">اختر الجنسية</option>
                                @foreach(App\Models\User::NATIONALITY_SELECT as $label)
                                    <option value="{{ $label }}" {{ old('nationality', '') === (string) $label ? 'selected' : '' }}>{{ trans('global.nationality.'.$label) }}</option>
                                @endforeach
                            </select> 
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                </div>  
            </div>


            

            <hr>
            
            <div class="row row-space"> <h4>بيانات الشركة</h4></div>

            <div class="row row-space">
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">اسم الشركة</label>
                        <input class="input--style-4" type="text" name="company_name" required value="{{old('company_name')}}"> 
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">رقم السجل التجاري</label>
                        <input class="input--style-4" type="text" name="commerical_reg_num" required value="{{old('commerical_reg_num')}}"> 
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">المجال</label>
                        <input class="input--style-4" type="text" name="working_field" required value="{{old('working_field')}}"> 
                    </div>
                </div> 
            </div>
            
            <div class="row row-space">
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">المدينة</label>
                        <div class="rs-select2 js-select-simple" style="width: 100%;">
                            <select name="city_id" required>
                                @foreach($cities as $id => $name)
                                    <option value="{{ $id }}"  {{ old('city_id','') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select> 
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                </div>  
                <div class="col-4">
                    <div class="input-group">
                        <label class="label">الموقع الألكتروني </label>
                        <input class="input--style-4" type="text" name="website"  value="{{old('website')}}"> 
                    </div>
                </div>
            </div>
            
            <div class="p-t-15">
                <button type="submit" class="contact-one__btn thm-btn">إتمام عملية التسجيل</button>
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