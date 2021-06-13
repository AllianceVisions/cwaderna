@extends('frontend.layout.frontend')
@section('content')   

@section('styles')
@parent 
    <link rel="stylesheet" href="{{asset('assets/css/wizard.css')}}"> 
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

<section class="form-box">
    <div class="container">
        
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-2 col-lg-12 col-lg-offset-3 form-wizard">
            
                <!-- Form Wizard -->
                <form role="form" action="" method="post">

                    <!-- Form progress -->
                    <div class="form-wizard-steps form-wizard-tolal-steps-4">
                        <div class="form-wizard-progress">
                            <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4" style="width: 12.25%;"></div>
                        </div>
                        <!-- Step 1 -->
                        <div class="form-wizard-step active">
                            <div class="form-wizard-step-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                            <p>البيانات الشخصية</p>
                        </div>
                        <!-- Step 1 -->
                        
                        <!-- Step 2 -->
                        <div class="form-wizard-step">
                            <div class="form-wizard-step-icon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
                            <p>التواصل</p>
                        </div>
                        <!-- Step 2 -->
                        
                        <!-- Step 3 -->
                        <div class="form-wizard-step">
                            <div class="form-wizard-step-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                            <p>الخبرات السابقة</p>
                        </div>
                        <!-- Step 3 -->
                        
                        <!-- Step 4 -->
                        <div class="form-wizard-step">
                            <div class="form-wizard-step-icon"><i class="fa fa-link" aria-hidden="true"></i></div>
                            <p>المرفقات</p>
                        </div>
                        <!-- Step 4 -->
                    </div>
                    <!-- Form progress -->
                    
                    
                    <!-- Form Step 1 -->
                    <fieldset>

                        <h4>البيانات الشخصية<span>الخطوة 1 - 4</span></h4>
                        <div class="form-group">
                            <label>الاسم الاول <span>*</span></label>
                            <input type="text" name="First Name" placeholder="الاسم الاول" class="form-control required">
                        </div>
                        <div class="form-group">
                            <label>الاسم الأخير <span>*</span></label>
                            <input type="text" name="Last Name" placeholder="الاسم الاخير" class="form-control required">
                        </div>
                        
                            <div class="form-group">
                            <label>رقم الهوية <span>*</span></label>
                            <input type="text" name="Last Name" placeholder="الاسم الاخير" class="form-control required">
                        </div>
                        
                        
                        <div class="input-group">
                            <label class="label">
                                النوع :</label>
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
                        
                        
                        <div class="container-fluid">
                        <div class="row form-inline">
                        <div class="form-group col-md-3 col-xs-3">
                            <label>تاريخ الميلاد </label>
                        </div>
                        <div class="form-group col-md-3 col-xs-3">
                            <label>اليوم:  </label>
                            <select class="form-control">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-xs-3">
                            <label>الشهر:  </label>
                            <select class="form-control">
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-xs-3">
                            <label>السنة: </label>
                            <select class="form-control">
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                            </select>
                        </div>
                        </div>
                        </div>
                        
                        <div class="form-group">
                            <label>اسم المستخدم : <span>*</span></label>
                            <input type="text" name="Username" placeholder="اسم المستخدم" class="form-control required">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور:  <span>*</span></label>
                            <input type="password" name="Password" placeholder="كلمة المرور" class="form-control required">
                        </div>
                        <div class="form-wizard-buttons">
                            <button type="button" class="btn btn-next">التالي</button>
                        </div>
                    </fieldset>
                    <!-- Form Step 1 -->

                    <!-- Form Step 2 -->
                    <fieldset>

                        <h4>بيانات التواصل <span>خطوة 2 من 4</span></h4>
                        <div class="form-group">
                            <label>البريد الإلكتروني <span>*</span></label>
                            <input type="email" name="Email" placeholder="البريد الإلكتروني" class="form-control required">
                        </div>
                        <div class="form-group">
                            <label>رقم الجوال <span>*</span></label>
                            <input type="text" name="Phone" placeholder="الجوال" class="form-control required">
                        </div>
                        <div class="form-group">
                            <label>العنوان  <span>*</span></label>
                            <input type="text" name="Address" placeholder="العنوان" class="form-control required">
                        </div>
                        
                        
                        <div class="form-group">
                            <label>المنطقة: <span>*</span></label>
                            <input type="text" name="State" placeholder="State" class="form-control required">
                        </div>
                        <div class="form-group">
                            <label>المدينة: </label>
                            <select class="form-control">
                                <option>جدة</option>
                                <option>الرياض</option>
                                <option>جدة</option>
                                <option>الرياض</option>
                            </select>
                        </div>
                        
                        <div class="form-wizard-buttons">
                            <button type="button" class="btn btn-previous">السابق</button>
                            <button type="button" class="btn btn-next">التالي</button>
                        </div>
                    </fieldset>
                    <!-- Form Step 2 -->

                    <!-- Form Step 3 -->
                    <fieldset>

                        <h4>الخبرات السابقة <span>خطوة 3 من 4</span></h4>
                        <div class="form-group">
                            <label>المسمة الوظيفي <span>*</span></label>
                            <input type="text" name="Employee ID" placeholder="المسمة الوظيفي" class="form-control required">
                        </div>
                        <div class="form-group">
                            <label>اسم الشركة <span>*</span></label>
                            <input type="text" name="Designation" placeholder="اسم الشركة" class="form-control required">
                        </div>
                        
                        
                        <div class="container-fluid">
                        <div class="row form-inline">
                        <div class="form-group col-md-3 col-xs-3">
                            <label>تاريخ الالتحاق </label>
                        </div>
                        <div class="form-group col-md-3 col-xs-3">
                            <label>اليوم: </label>
                            <select class="form-control">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-xs-3">
                            <label>الشهر: </label>
                            <select class="form-control">
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-xs-3">
                            <label>السنه: </label>
                            <select class="form-control">
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                            </select>
                        </div>
                            
                        </div>
                        </div>
                        
                            <div class="form-group">
                            <label>الرغبة في العمل: </label>
                            <select class="form-control">
                                <option>عامل</option>
                                <option>ممثل</option>
                                <option>عامل</option>
                                <option>ممثل</option>
                            </select>
                        </div>
                        
                        
                        <br/>
                        <div class="form-wizard-buttons">
                            <button type="button" class="btn btn-previous">السابق</button>
                            <button type="button" class="btn btn-next">التالي</button>
                        </div>
                    </fieldset>
                    <!-- Form Step 3 -->
                    
                    <!-- Form Step 4 -->
                    <fieldset> 
                        <h4>المرفقات <span> خطوة 4 من 4</span></h4>
                        <div style="clear:both;"></div>
                            <div class="form-group">
                            <label>الصورة الشخصية<span>*</span></label>
                            <div class="input-group">
                                
                                                    
                        <span class="input-group-btn">
                            
                                        <span class="btn btn-primary btn-file">
                                            اختر الملف  <input type="file" name="FileAttachment" id="FileAttachment">
                                        </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                        </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>الشهادات<span>*</span></label>
                                                    <div class="input-group">
                                                        
                                                        
                            <span class="input-group-btn">
                                
                                            <span class="btn btn-primary btn-file">
                                                اختر الملف  <input type="file" name="FileAttachment" id="FileAttachment">
                                            </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                                            </div>
                                            
                                            
                                        
                        <br/>
                        <div class="form-wizard-buttons">
                                <button type="button" class="btn btn-previous">السابق</button>
                            <button type="button" class="btn btn-next">التالي</button>
                        </div>
                    </fieldset>
                    <!-- Form Step 4 -->
                
                </form>
                <!-- Form Wizard -->
            </div>
        </div>
            
    </div>
</section>

@endsection

@section('scripts')
@parent
    <script>

        window.console = window.console || function(t) {};

        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>

        <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>

    <script id="rendered-js" >   
        "use strict";
        function scroll_to_class(element_class, removed_height) {
        var scroll_to = $(element_class).offset().top - removed_height;
        if ($(window).scrollTop() != scroll_to) {
        $('.form-wizard').stop().animate({ scrollTop: scroll_to }, 0);
        }
        }

        function bar_progress(progress_line_object, direction) {
        var number_of_steps = progress_line_object.data('number-of-steps');
        var now_value = progress_line_object.data('now-value');
        var new_value = 0;
        if (direction == 'right') {
        new_value = now_value + 100 / number_of_steps;
        } else
        if (direction == 'left') {
        new_value = now_value - 100 / number_of_steps;
        }
        progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
        }

        jQuery(document).ready(function () {

        /*
                                            Form
                                        */
        $('.form-wizard fieldset:first').fadeIn('slow');

        $('.form-wizard .required').on('focus', function () {
        $(this).removeClass('input-error');
        });

        // next step
        $('.form-wizard .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.form-wizard').find('.form-wizard-step.active');
        var progress_line = $(this).parents('.form-wizard').find('.form-wizard-progress-line');

        // fields validation
        parent_fieldset.find('.required').each(function () {
            if ($(this).val() == "") {
            $(this).addClass('input-error');
            next_step = false;
            } else
            {
            $(this).removeClass('input-error');
            }
        });
        // fields validation

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
            // change icons
            current_active_step.removeClass('active').addClass('activated').next().addClass('active');
            // progress bar
            bar_progress(progress_line, 'right');
            // show next step
            $(this).next().fadeIn();
            // scroll window to beginning of the form
            scroll_to_class($('.form-wizard'), 20);
            });
        }

        });

        // previous step
        $('.form-wizard .btn-previous').on('click', function () {
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.form-wizard').find('.form-wizard-step.active');
        var progress_line = $(this).parents('.form-wizard').find('.form-wizard-progress-line');

        $(this).parents('fieldset').fadeOut(400, function () {
            // change icons
            current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
            // progress bar
            bar_progress(progress_line, 'left');
            // show previous step
            $(this).prev().fadeIn();
            // scroll window to beginning of the form
            scroll_to_class($('.form-wizard'), 20);
        });
        });

        // submit
        $('.form-wizard').on('submit', function (e) {

        // fields validation
        $(this).find('.required').each(function () {
            if ($(this).val() == "") {
            e.preventDefault();
            $(this).addClass('input-error');
            } else
            {
            $(this).removeClass('input-error');
            }
        });
        // fields validation

        });


        });

        // image uploader scripts 

        var $dropzone = $('.image_picker'),
        $droptarget = $('.drop_target'),
        $dropinput = $('#inputFile'),
        $dropimg = $('.image_preview'),
        $remover = $('[data-action="remove_current_image"]');

        $dropzone.on('dragover', function () {
        $droptarget.addClass('dropping');
        return false;
        });

        $dropzone.on('dragend dragleave', function () {
        $droptarget.removeClass('dropping');
        return false;
        });

        $dropzone.on('drop', function (e) {
        $droptarget.removeClass('dropping');
        $droptarget.addClass('dropped');
        $remover.removeClass('disabled');
        e.preventDefault();

        var file = e.originalEvent.dataTransfer.files[0],
        reader = new FileReader();

        reader.onload = function (event) {
            $dropimg.css('background-image', 'url(' + event.target.result + ')');
        };

        console.log(file);
        reader.readAsDataURL(file);

        return false;
        });

        $dropinput.change(function (e) {
        $droptarget.addClass('dropped');
        $remover.removeClass('disabled');
        $('.image_title input').val('');

        var file = $dropinput.get(0).files[0],
        reader = new FileReader();

        reader.onload = function (event) {
            $dropimg.css('background-image', 'url(' + event.target.result + ')');
        };

        reader.readAsDataURL(file);
        });

        $remover.on('click', function () {
        $dropimg.css('background-image', '');
        $droptarget.removeClass('dropped');
        $remover.addClass('disabled');
        $('.image_title input').val('');
        });

        $('.image_title input').blur(function () {
        if ($(this).val() != '') {
            $droptarget.removeClass('dropped');
        }
        });

        // image uploader scripts
        //# sourceURL=pen.js

    </script>
@endsection