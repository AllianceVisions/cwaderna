@extends('layouts.frontend')
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
        <h2 class="inner-banner__title">تسجيل طالب كوادر</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>
    
<section class="form-box" >
    <div class="container"> 
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-2 col-lg-12 col-lg-offset-3 form-wizard"> 
                <!-- Form Wizard -->
                
        @if($errors->count() > 0) 
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{$error}} <br>
                @endforeach
            </div>
        @endif
                <form role="form" action="{{route('organizers.register_submit')}}" method="post" enctype="multipart/form-data"> 
                    @csrf
                    <!-- Form progress -->
                    <div class="form-wizard-steps form-wizard-tolal-steps-3">
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
                        {{-- <div class="form-wizard-step">
                            <div class="form-wizard-step-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                            <p>الكوادر المطلوبة </p>
                        </div> --}}
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

                        <h4>البيانات الشخصية<span>الخطوة 1 - 3</span></h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاسم الاول <span>*</span></label>
                                    <input type="text" name="first_name" value="{{old('first_name')}}" required  class="form-control required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاسم الأخير <span>*</span></label>
                                    <input type="text" name="last_name" value="{{old('last_name')}}" required  class="form-control required">
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>البريد الإلكتروني <span>*</span></label>
                                    <input type="email" name="email" value="{{old('email')}}" required  class="form-control required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>كلمة المرور:  <span>*</span></label>
                                    <input type="password" name="password" class="form-control required">
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>رقم الهوية <span>*</span></label>
                                    <input type="text" name="national_id"  class="form-control required">
                                </div> 
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>الجنسية: </label>
                                    <select class="form-control" name="nationality">
                                        <option disabled="disabled" selected="selected">اختر الجنسية</option>
                                        @foreach(App\Models\User::NATIONALITY_SELECT as $label)
                                            <option value="{{ $label }}" {{ old('nationality', '') === (string) $label ? 'selected' : '' }}>{{ trans('global.nationality.'.$label) }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>اسم الشركة <span>*</span></label>
                                    <input type="text" name="company_name" value="{{old('company_name')}}" required  class="form-control required">
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <div class="input-group">
                                    <label class="label">
                                        النوع :</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">ذكر
                                            <input type="radio" checked="checked" name="gender" value="male">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">انثى
                                            <input type="radio" name="gender" value="female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="form-wizard-buttons">
                            <button type="button" class="btn btn-next">التالي</button>
                        </div>
                    </fieldset>
                    <!-- Form Step 1 -->

                    <!-- Form Step 2 -->
                    <fieldset>

                        <h4>بيانات التواصل <span>خطوة 2 من 3</span></h4>
                        <div class="form-group">
                            <label>رقم الجوال <span>*</span></label>
                            <input type="text" name="phone" value="{{old('phone')}}" required class="form-control required">
                        </div> 
                        <div class="form-group">
                            <label>المدينة: </label>
                            <select name="city_id" required class="form-control">
                                @foreach($cities as $id => $name)
                                    <option value="{{ $id }}"  {{ old('city_id','') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select> 
                        </div>
                        
                        <div class="form-wizard-buttons">
                            <button type="button" class="btn btn-previous">السابق</button>
                            <button type="button" class="btn btn-next">التالي</button>
                        </div>
                    </fieldset>
                    <!-- Form Step 2 -->

                    <!-- Form Step 3 -->
                    {{-- <fieldset>

                        <h4>الكوادر المطلوبة <span>خطوة 3 من 4</span></h4>
                    
                        
                            <div class="form-group">
                            <label>نوع الكوادر</label>
                            <select class="form-control">
                                <option>عامل</option>
                                <option>ممثل</option>
                                <option>عامل</option>
                                <option>ممثل</option>
                            </select>
                        </div>
                        
                        
                                <div class="input-group">
                            <label class="label">
                                هل الكوادر موجودة بالموقع :</label>
                            <div class="p-t-10">
                                <label class="radio-container m-r-45">نعم 
                                    <input type="radio" checked="checked" name="gender">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">لا
                                    <input type="radio" name="gender">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        
                        
                        <br/>
                        <div class="form-wizard-buttons">
                            <button type="button" class="btn btn-previous">السابق</button>
                            <button type="button" class="btn btn-next">التالي</button>
                        </div>
                    </fieldset> --}}
                    <!-- Form Step 3 -->
							
                    <!-- Form Step 4 -->
                    <fieldset>

                        <h4>المرفقات <span> خطوة 3 من 3</span></h4>
                        <div style="clear:both;"></div> 
                            <div class="form-group">
                                <label for="commericalreg">السجل التجاري</label>
                                <div class="needsclick dropzone {{ $errors->has('commericalreg') ? 'is-invalid' : '' }}" id="commericalreg-dropzone">
                                </div> 
                            </div>      
                            <div class="form-group">
                                <label for="identity">الهوية</label>
                                <div class="needsclick dropzone {{ $errors->has('identity') ? 'is-invalid' : '' }}" id="identity-dropzone">
                                </div> 
                            </div>       
                        <br/>
                        <div class="form-wizard-buttons">
                                <button type="button" class="btn btn-previous">السابق</button>
                            <button type="submit" class="btn btn-info">إتمام عملية التسجيل</button>
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

    
<script>
    Dropzone.options.identityDropzone = {
        url: '{{ route('organizers.storeMedia') }}',
        maxFilesize: 2, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2
        },
        success: function (file, response) {
        $('form').find('input[name="identity"]').remove()
        $('form').append('<input type="hidden" name="identity" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="identity"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        }, 
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
    
<script>
    Dropzone.options.commericalregDropzone = {
        url: '{{ route('organizers.storeMedia') }}',
        maxFilesize: 2, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2
        },
        success: function (file, response) {
        $('form').find('input[name="commerical_reg"]').remove()
        $('form').append('<input type="hidden" name="commerical_reg" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="commerical_reg"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        }, 
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
@endsection