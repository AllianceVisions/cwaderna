@extends('layouts.frontend')
@section('styles') 
<link rel="stylesheet" href="{{asset('css/model.css')}}">
<style> 
    .team-one__image img { border-radius: 0;}
</style>
@endsection
@section('content') 

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#">خدماتنا</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">خدماتنا</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section> 

<section class="team-one team-page">
    <div class="container"> 
        <div class="row">
            @foreach($items as $item)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="team-one__single team-one__content" >
                        <div class="team-one__image">
                            <img src="{{asset($item->photo->getUrl('preview'))}}" alt="">

                        </div><!-- /.team-one__image -->
                        <div class="">
                            <h2 class="team-one__name"><a href="services.html">{{$item->title}}</a></h2>
                            <!-- /.team-one__name -->
                            <p class="team-one__text">{{$item->description}}</p>

                            <a href="services.html" class="course-one__link">المزيد</a><a  data-popup-open="popup-{{$item->id}}" href="#" class="course-one__link ">طلب الخدمة</a>
                            <!-- /.team-one__text -->
                        </div><!-- /.team-one__content --> 
                    </div>
                </div><!-- /.col-lg-3 -->
            @endforeach
        </div><!-- /.row -->
        <div class="post-pagination">
            {{ $items->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div><!-- /.container -->
</section><!-- /.team-one team-page -->

@foreach($items as $item)
    <div class="popup" data-popup="popup-{{$item->id}}" style="z-index: 999">
        <div class="popup-inner sponsors_inner">
            <div class="container">
                <form class="form-signin" method="POST" action="{{route('frontend.add_service_to_event')}}">
                    @csrf
                    <input type="hidden" name="item_id" id="item_id" value="{{$item->id}}">
                    <div class="form-group">
                    <label>اختر الفعالية</label>
                        <select class="form-control" id="sel1" placeholder="عنوان الفعالية" name="event_id" required>
                            @foreach($events as $event)
                                <option value="{{$event->id}}">{{$event->title}}</option> 
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="dates-wrapper group">
                                <div class="field clearfix ">
                                <div class="label">
                                    <label for="datepicker-start">تاريخ البداية</label>
                                </div>
                                <div class="input">
                                    <input
                                    type="datetime-local"
                                    name="start_attendance"
                                    id="datepicker-start"
                                    class="input-text"
                                    placeholder="dd/mm/yyyy"
                                    required
                                    />
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="dates-wrapper group">
                                    <div class="field clearfix ">
                                    <div class="label">
                                        <label for="datepicker-start">تاريخ النهاية</label>
                                    </div>
                                    <div class="input">
                                        <input
                                        type="datetime-local"
                                        name="end_attendance"
                                        id="datepicker-start"
                                        class="input-text"
                                        placeholder="dd/mm/yyyy"
                                        required
                                        />
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="note">
                    </div>

                    <div class="clear"></div>
                    <div class="text-right">
                    <button type="submit" class="thm-btn">تنفيذ الطلب</button>
                    </div>
                </form>
            </div>

            <a class="popup-close" data-popup-close="popup-{{$item->id}}" href="#">x</a>
        </div>
    </div>
@endforeach

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

    $(function() {
        //----- OPEN
        $('[data-popup-open]').on('click', function(e)  {
            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
    
            e.preventDefault();
        });
    
        //----- CLOSE
        $('[data-popup-close]').on('click', function(e)  {
            var targeted_popup_class = jQuery(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
    
            e.preventDefault();
        });
    });
</script>
@endsection