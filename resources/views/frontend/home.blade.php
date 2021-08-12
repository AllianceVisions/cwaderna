@extends('layouts.frontend')

@section('content') 

    {{-- Slider --}} 
    <div class="banner-wrapper" style="direction: ltr; text-align: left;">
        <section class="banner-two banner-carousel__one no-dots owl-theme owl-carousel">
            <div class="banner-two__slide banner-two__slide-one" style="background-image: url('{{asset('assets/images/slider-2-1.jpg')}}');"> 
                <div class="darklayer">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <h3 class="banner-two__title banner-two__light-color">عنوان الفعالية <br>
                                </h3>
                            
                            <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p><!-- /.banner-two__title -->
                            <a href="#" class="thm-btn banner-two__btn">المزيد</a>
                        </div><!-- /.col-xl-12 -->
                    </div><!-- /.row -->
                    </div><!-- /.container --></div>
            </div><!-- /.banner-two__slide -->
            <div class="banner-two__slide banner-two__slide-two" style="background-image: url('{{asset('assets/images/slider-2-2.jpg')}}');">
                <div class="darklayer">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <h3 class="banner-two__title banner-two__light-color">
                                    عنوان الفعالية <br>
                                </h3>
                                
                                <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p><!-- /.banner-two__title -->
                                <a href="#" class="thm-btn banner-two__btn">المزيد</a>
                            </div><!-- /.col-xl-12 -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div>
            </div><!-- /.banner-two__slide -->
        </section><!-- /.banner-two -->
        <div class="banner-carousel-btn">
            <a href="#" class="banner-carousel-btn__left-btn"><i class="kipso-icon-left-arrow"></i></a>
            <a href="#" class="banner-carousel-btn__right-btn"><i class="kipso-icon-right-arrow"></i></a>
        </div><!-- /.banner-carousel-btn -->
    </div><!-- /.banner-wrapper --> 
    {{-- Slider --}}

    {{-- Services --}}
    <div class="home--services">
            <div class="container">
            <div class="row">
                <!-- /.home--services -->
        <div class="col-md-3 col-xs-6">
            <div class="home--serv bg-theme-1">
                <a href="{{route('frontend.organizers')}}">
                    <div class="icon"> <img src="{{asset('assets/images/home_icon_01.png')}}"> </div>
                    <div class="title"> منظمي الفعاليات</div>
                </a>
            </div>
        </div>
            <!-- /.home--services -->     
                
        
            <!-- /.home--services -->   
                
                
                <!-- /.home--services -->
        <div class="col-md-3 col-xs-4">
            <div class="home--serv bg-theme-2">
                <a href="{{route('frontend.all_services')}}">
                    <div class="icon"> <img src="{{asset('assets/images/home_icon_02.png')}}"> </div>
                    <div class="title"> الخدمات</div>
                </a>
            </div>
        </div>
            <!-- /.home--services -->   
                
                
                <!-- /.home--services -->
        <div class="col-md-3 col-xs-5">
            <div class="home--serv bg-theme-4">
                <a href="{{route('frontend.cwaders')}}">
                    <div class="icon"> <img src="{{asset('assets/images/home_icon_03.png')}}">  </div>
                    <div class="title"> الكوادر</div>
                </a>
            </div>
        </div>
            <!-- /.home--services -->   
                
                
                <!-- /.home--services -->
        <div class="col-md-3 col-xs-6">
            <div class="home--serv bg-theme-3">
                <a href="{{route('frontend.tickets')}}">
                    <div class="icon"> <img src="{{asset('assets/images/home_icon_04.png')}}"> </div>
                    <div class="title"> التذاكر  </div>
                </a>
            </div>
        </div>
            <!-- /.home--services -->   
                
        </div>
        </div>
    </div>      
    {{-- Services --}}

    {{-- About --}}
    <div class="container">
        <section class="cta-three">
    
        <div class="row">
            <div class="col-lg-4 clearfix">
                <img src="{{asset('assets/images/home_about.png')}}" class="img-fluid" alt="">
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-8">
                <div class="cta-three__content">
                    <div class="block-title text-left">
                        <h2 class="block-title__title">من نحن / وماذا نفعل؟</h2><!-- /.block-title__title -->
                    </div><!-- /.block-title -->
                    <p class="cta-three__text">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أوكوادرنا هي منصة إلكترونية سعودية تجمع لك كل الكوادر المدربه والمهئيه لجميع الأنشطة والفعاليات والدورات المقامة في مدينتك وتشارك معك في نجاح هذه الانشطه والفعاليات.</p>

                    <h3> أهدافنا </h3>
                    <p class="cta-three__text">

                    ان نكون الجهه الرائده محلياً في تقديم وتأهيل وتدريب الكوادر الفعاله لجميع الانشطه والفعاليات  وبناء كوادر من المعرفه والتدريب في المستقبل.

                    </p>
                    
                    
                    <!-- /.cta-three__text -->
                    
                    <a href="{{route('frontend.aboutus')}}" class="thm-btn">المزيد</a><!-- /.thm-btn -->
                </div><!-- /.cta-three__content -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
            </section>
    </div><!-- /.container --> 
    {{-- About --}}


    <section class="team-one team-page">
        <div class="container">
            <div class="block-title">
                <h2 class="block-title__title">كوادرنا</h2><!-- /.block-title__title -->
            </div><!-- /.block-title -->
            
            <div class="course-one__carousel owl-carousel owl-theme" style="direction: ltr;">
                @foreach($caders as $cader)
                    <div class="item">
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
                                <p class="team-one__text"> شارك في {{$cader->events()->where('events.status','accepted')->wherePivot('status','accepted')->get()->count()}} فعالية <span><i class="fab fa-staylinked"></i></span>  </p>
                                <a href="{{route('frontend.cader.single',$cader->id)}}" class="course-one__link">المزيد</a>
                                <!-- /.team-one__text -->
                            </div><!-- /.team-one__content -->
                            
                        </div>
                    </div><!-- /.item -->
                @endforeach
            </div><!-- /.course-one__carousel -->
        </div><!-- /.container -->
    </section><!-- /.course-one course-page -->
    
@endsection