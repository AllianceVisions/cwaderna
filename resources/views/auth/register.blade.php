@extends('frontend.layout.frontend') 
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
        <h2 class="inner-banner__title">تسجيل كادر</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>
<div class="about">
    <div class="container">  
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row row-space"> <h4>بيانات عامة</h4></div>

            <div class="row row-space">
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">الاسم الاول</label>
                        <input class="input--style-4" type="text" name="first_name">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">الاسم الاخير</label>
                        <input class="input--style-4" type="text" name="last_name">
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-6">
                    <div class="input-group">
                        <label class="label" style="width: 100%;">تاريخ الميلاد</label>
                        <div class="input-group-icon" style="width: 100%;">
                            <input class="input--style-4 js-datepicker" type="text" name="birthday" >
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">النوع</label>
                        <div class="p-t-10">
                            <label class="radio-container m-r-45">ذكر
                                <input type="radio" checked="checked" name="gender">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-container">انثى
                                <input type="radio" name="gender">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-space">
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">البريد الإلكتروني</label>
                        <input class="input--style-4" type="email" name="email">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">رقم التليفون</label>
                        <input class="input--style-4" type="text" name="phone">
                    </div>
                </div>
            </div>
            
            <div class="row row-space">
                <div class="col-6">
                    <div class="input-group">
                        <label class="label" style="width: 100%;">الجنسية</label> 
                        <div class="rs-select2 js-select-simple select--no-search" style="width: 100%;">
                            <select name="subject">
                                <option disabled="disabled" selected="selected">اختر الجنسية</option>
                                <option>سعودي</option>
                                <option>فلبييني</option>
                                <option>مصري</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">الرقم القومي </label>
                        <input class="input--style-4" type="text" name="phone">
                    </div>
                </div>
            </div>
                        
            
            <hr />
            
            <div class="row row-space"> <h4>التعليم</h4></div> 

            <div class="row row-space">
                <div class="col-6">
                    <div class="input-group">
                        <label class="label" style="width: 100%;">الدرجة العلمية</label>
                        <div class="rs-select2 js-select-simple select--no-search" style="width: 100%;">
                            <select name="subject">
                                <option disabled="disabled" selected="selected" >اختر الدرجة العلمية</option>
                                <option>تعليم عالي</option>
                                <option>دبلوم</option>
                                <option>ماجستير</option>
                                <option>دكتوراه</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">اسم الجامعة </label>
                        <input class="input--style-4" type="text" name="phone">
                    </div>
                </div> 
                <div class="addrow">  <a href="#"> + إضافة </a></div>
            </div>
            
                
            <hr />
            
            <div class="row row-space"> <h4>الخبرات السابقة</h4></div>

            <div class="row row-space">
                <div class="col-12">
                    <div class="input-group">
                        <label class="label"> اسم الشركة </label>
                        <input class="input--style-4" type="text" name="phone">
                    </div>
                </div> 
            </div>
            
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <label class="label" style="width: 100%;">من</label>
                        <div class="input-group-icon" style="width: 100%;">
                            <input class="input--style-4 js-datepicker" type="text" name="birthday" >
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="input-group">
                        <label class="label" style="width: 100%;">إلى</label>
                        <div class="input-group-icon" style="width: 100%;">
                            <input class="input--style-4 js-datepicker" type="text" name="birthday" >
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="row row-space">
                <div class="col-6">
                    <div class="input-group">
                        <label class="label" style="width: 100%;">طبيعة الوظيفة </label>
                        <div class="rs-select2 js-select-simple select--no-search" style="width: 100%;">
                            <select name="subject">
                                <option disabled="disabled" selected="selected" >اختر الدرجة العلمية</option>
                                <option>طبيعة الوظيفة</option>
                                <option>طبيعة الوظيفة</option>
                                <option>طبيعة الوظيفة</option>
                                <option>طبيعة الوظيفة</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    
                </div>
                    
                <div class="addrow">  <a href="#"> + إضافة </a></div>
            </div>
            
            
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <select class="custom-select" multiple>
                            <option selected>المؤهلات </option>
                            <option value="1">الاختيار الاول</option>
                            <option value="2">الاختيار الثاني</option>
                            <option value="3">الاختيار الثالث</option>
                        </select>                                
                    </div>
                </div>
            </div>
            
                
            <div class="row">
                <div class="col-6">
                    <label class="label" style="width: 100%;">ارفاق السيرة الذاتية </label> 
                    <div class="file-upload">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Choose File</div>
                            <div class="file-select-name" id="noFile">No file chosen...</div> 
                            <input type="file" name="chooseFile" id="chooseFile">
                        </div>
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