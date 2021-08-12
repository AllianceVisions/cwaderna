@extends('layouts.frontend')
@section('styles') 
<link rel="stylesheet" href="{{asset('css/model.css')}}">
<style>  
</style>
@endsection
@section('content') 

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#">كوادرنا</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">عمال</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<section class="team-one team-page">
    <div class="container"> 
        <div class="row ">
            <div class="main_btn_inside">
                <a href="{{route('frontend.cader.register')}}" class="thm-btn">التسجيل ككادر </a>
                <a href="{{route('frontend.all_services')}}" class="thm-btn"> أطلب خدمة </a> 
            </div>
        </div>
        <div class="row">
            @foreach($caders as $cader)
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="team-one__single team-one__content" >
                        <div class="team-one__image">
                            @if($cader->user->photo)
                                <img src="{{asset($cader->user->photo->getUrl('thumb'))}}" alt="">
                            @else 
                                <img src="{{asset('user.png')}}" alt="">
                            @endif
                            <p class="team-one__designation">{{$cader->specializations ? $cader->specializations->first()->name_ar ?? "" : ""}}</p><!-- /.team-one__designation -->

                        </div><!-- /.team-one__image -->
                        <div class="">
                            <h2 class="team-one__name"><a href="team-details.html">{{$cader->user->first_name . " " . $cader->user->last_name}}</a></h2>
                            <!-- /.team-one__name --> 
                            <br>
                            <p class="team-one__text"><span><i class="fab fa-staylinked"></i></span>  شارك في {{$cader->events()->where('events.status','accepted')->wherePivot('status','accepted')->get()->count()}} فعالية  </p>
                            <a href="{{route('frontend.cader.single',$cader->id)}}" class="course-one__link">المزيد</a>
                            <a data-popup-open="popup-{{$cader->id}}" href="#" class="course-one__link">طلب الكادر</a>
                            <!-- /.team-one__text -->
                        </div><!-- /.team-one__content -->
                        
                    </div>
                </div><!-- /.col-lg-3 --> 
            @endforeach
        </div><!-- /.row -->
        
        <div class="post-pagination">
            {{ $caders->links('vendor.pagination.bootstrap-4') }}
        </div> 
    </div><!-- /.container -->
</section><!-- /.team-one team-page -->

@foreach($caders as $cader)
    <div class="popup" data-popup="popup-{{$cader->id}}" style="z-index: 999">
        <div class="popup-inner sponsors_inner">
            <div class="container">
                @auth 
                    @if(Auth::user()->user_type == 'events_organizer')
                        
                        <form class="form-signin" method="POST" action="{{route('frontend.add_cader_to_event')}}">
                            @csrf
                            <input type="hidden" name="cader_id" id="cader_id" value="{{$cader->id}}">
                            <div class="form-group">
                                <label>اختر الفعالية</label>
                                <select class="form-control" id="sel1" name="event_id" placeholder="عنوان الفعالية" required>
                                    @foreach($events as $event)
                                        <option value="{{$event->id}}">{{$event->title}}</option> 
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>اختر التخصص للكادر</label>
                                <select class="form-control" id="sel1" name="specialization_id" placeholder="تخصص الكادر" required>
                                    @foreach($specializations as $specialize)
                                        @if($cader->specializations->contains($specialize->id))
                                            <option value="{{ $specialize->id }}">{{$specialize->name_ar}}</option>
                                        @endif
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

                    @else 
                        هذه الخدمة لمنظمي الفعاليات فقط
                        <a class="btn btn-outline-danger text-dark" style="border-radius:30px" href="{{route('organizers.register')}}">تسجيل كمنظم فعاليات</a>
                    @endif
                @else 
                        
                    <a href="{{route('login')}}" class="btn btn-success"><i class="far fa-user"></i> دخول</a>
                    <a href="{{route('caders.register')}}" class="btn btn-info"><i class="fas fa-user-plus"></i> مستخدم جديد</a>
                @endauth
            </div>

            <a class="popup-close" data-popup-close="popup-{{$cader->id}}" href="#">x</a>
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