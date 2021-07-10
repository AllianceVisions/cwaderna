@extends('layouts.frontend')
@section('content')   

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#">الخدمات</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">طلب خدمة</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<div class="requist">
    <div class="container">
        <form class="form-signin">        
            <div class="form-group">
                <label>نوع الخدمة:</label>
                <select class="form-control" id="sel1" placeholder="عنوان الفعالية"> 
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label> عدد الكوادر:</label>
                        <select class="form-control" id="sel1" placeholder="عنوان الفعالية"> 
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div> 
                </div>
                                    
                <div class="col-md-6">
                                    
                    <div class="dates-wrapper group">
                    
                    <div class="field clearfix date-range-start date-wrapper">
                        <div class="label">
                        <label for="datepicker-start">تاريخ البداية</label>
                        </div>
                        <div class="input">
                        <input type="date" name="experience-start" id="datepicker-start" class="input-text" placeholder="dd/mm/yyyy">
                        </div>
                    </div>

                    <div class="field clearfix date-range-start date-wrapper">
                        <div class="label">
                        <label for="datepicker-end">تاريخ النهاية:</label>
                        </div>
                        <div class="input">
                        <input type="date" name="experience-end" id="datepicker-end" class="input-text" placeholder="dd/mm/yyyy">
                        </div>
                    </div>
                    
                    </div>                 
                </div>
            </div>

            <div class="form-group">
                <label> معلومات اضافية</label>
                <textarea placeholder="معلومات اضافية"></textarea>
            </div>

            <div class="clear"></div>
            <div class="text-right">
                <button type="submit" class="contact-one__btn thm-btn-border" >   اضافة خدمة اخري</button>
                <button type="submit" class="thm-btn" >  ارسال الطلب</button> 
            </div>
        </form>
    </div>
</div> 

@endsection

@section('scripts')
@parent
    <script>
        /*if ( $('[type="date"]').prop('type') != 'date' ) {
        } */

        if ( $('html').hasClass('no-touch') ) {
            var $input, $btn;
            $( ".date-wrapper" ).each(function( index ) {
                $input = $(this).find('input');
                $btn = $(this).find('.calendar-btn');
                $input.attr('type', 'text');
                var pickerStart = new Pikaday({
                    field: $input[0],
                    trigger: $btn[0],
                    container: $(this)[0],
                    format: 'DD/MM/YYYY',
                    firstDay: 1
                });
                $btn.show();
            });
        } else {
            $('.date-wrapper input').attr('type', 'date');
            $('.calendar-btn').hide();
        }
    </script>
@endsection