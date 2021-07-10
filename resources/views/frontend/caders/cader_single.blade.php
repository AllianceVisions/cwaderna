@extends('layouts.frontend')

@section('styles')
<style>
    .progress-one__wrap{
        height: 300px;
        overflow: scroll;
        padding: 15px
    }
    .progress-one__wrap::-webkit-scrollbar {
        width: 5px;
    }

    .progress-one__wrap::-webkit-scrollbar-track {
        background:rgba(0,0,0,.0); 
        border-radius: 10px;
    }

    .progress-one__wrap::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: rgba(0,0,0,.3); 
    }
    .progress-one__wrap::-webkit-scrollbar-thumb:hover {
        background: black; 
    }
</style>
@endsection
@section('content')   

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#">الصفحة الشخصية للكادر</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">{{$cader->user->first_name . " " . $cader->user->last_name}}</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section> 

<section class="team-details">
    <div class="container">
        <div class="row">
    
            <div class="col-lg-4">
                <div class="team-one__single">
                    <div class="team-one__image"> 
                        @if($cader->user->photo)
                            <img src="{{asset($cader->user->photo->getUrl('preview'))}}" class="img-fluid" alt="">
                        @else
                            <img src="{{asset('user.png')}}" class="img-fluid" alt="">
                        @endif
                    </div><!-- /.team-one__image --> 
                </div><!-- /.team-one__single -->
            </div><!-- /.col-lg-6 -->
                    <div class="col-md-8">
                <div class="team-details__content">
                    <h2 class="team-details__title">نبذة </h2><!-- /.team-details__title -->
                    <p class="team-details__text">
                        <?php echo nl2br($cader->description); ?>   
                    </p><!-- /.team-details__text -->
                    <h3 class="team-details__subtitle">الشهادات</h3><!-- /.team-details__subtitle -->
                    <ul class="list-unstyled team-details__certificate-list">
                        @if($cader->user && $cader->user->certificates)
                            @foreach($cader->user->certificates as $key => $media)
                                <li>
                                    <a href="{{ asset($media->getUrl()) }}" target="_blank" style="display: inline-block">
                                        <img src="{{asset($media->getUrl('preview'))}}" alt="">
                                    </a>
                                </li> 
                            @endforeach
                        @endif 
                    </ul><!-- /.list-unstyled -->
                    
                    
                    
                    <h3 class="team-details__subtitle">المهارات</h3><!-- /.team-details__subtitle -->

                    <div class="progress-one__wrap"  style="direction: rtl;">
                        @foreach($cader->skills as $skill)
                            <div class="progress-one__single">
                                <div class="progress-one__top">
                                    <h3 class="progress-one__title">{{ $skill->name_ar }}</h3><!-- /.progress-one__title -->
                                    <h3 class="progress-one__percent"><span class="counter">{{ $skill->pivot->progress }}</span><!-- /.counter -->%
                                    </h3><!-- /.progress-one__percent -->
                                </div><!-- /.progress-one__top -->
                                <div class="progress-one__bar">
                                    <span style="width: {{ $skill->pivot->progress }}%;" class="wow slideInLeft"></span>
                                </div><!-- /.progress-one__bar -->
                            </div><!-- /.progress-one__single -->
                        @endforeach
                    </div><!-- /.progress-one__wrap -->
                </div><!-- /.team-details__content -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.team-details -->

<!----------------Events-------->  

<section class="course-one course-one__teacher-details home-one">
    <div class="container">
        <h2 class="team-details__title"> فعاليات شارك فيها </h2>
        <div class="row">
                <!-- /.item -->
                <!-- /.item -->
                <!-- /.item -->
                <!-- /.item -->
                <!-- /.item -->
                <!-- /.item -->
                <!-- /.item -->
                <!-- /.item -->
                <!-- /.item -->
        
            <section class="blog-one blog-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="blog-one__single">
                                <div class="blog-one__image">
                                    <img src="{{asset('assets/images/blog-1-1.jpg')}}" alt="">
                                    <a class="blog-one__plus" href="news-details.html"><i class="kipso-icon-plus-symbol"></i>
                                        <!-- /.kipso-icon-plus-symbol --></a>
                                </div><!-- /.blog-one__image -->
                                <div class="blog-one__content text-center">
                                    <div class="blog-one__meta">
                                        <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted On Jan 19"><i class="fa fa-calendar-alt"></i></a>
                                        
                                        <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted By Admin"><i class="fa fa-user"></i></a>
                                    </div><!-- /.blog-one__meta -->
                                    <h2 class="blog-one__title"><a href="news-details.html">اسم الفعالية</a>
                                    </h2><!-- /.blog-one__title -->
                                    <p class="blog-one__text">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p><!-- /.blog-one__text -->
                                    <a href="news-details.html" class="blog-one__link">المزيد</a><!-- /.blog-one__link -->
                                </div><!-- /.blog-one__content -->
                            </div><!-- /.blog-one__single -->
                        </div><!-- /.col-lg-4 -->
                        <div class="col-lg-3">
                        <div class="blog-one__single">
                                <div class="blog-one__image">
                                    <img src="{{asset('assets/images/blog-1-1.jpg')}}" alt="">
                                    <a class="blog-one__plus" href="news-details.html"><i class="kipso-icon-plus-symbol"></i>
                                        <!-- /.kipso-icon-plus-symbol --></a>
                                </div><!-- /.blog-one__image -->
                                <div class="blog-one__content text-center">
                                    <div class="blog-one__meta">
                                        <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted On Jan 19"><i class="fa fa-calendar-alt"></i></a>
                                        
                                        <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted By Admin"><i class="fa fa-user"></i></a>
                                    </div><!-- /.blog-one__meta -->
                                    <h2 class="blog-one__title"><a href="news-details.html">اسم الفعالية</a>
                                    </h2><!-- /.blog-one__title -->
                                    <p class="blog-one__text">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p><!-- /.blog-one__text -->
                                    <a href="news-details.html" class="blog-one__link">المزيد</a><!-- /.blog-one__link -->
                                </div><!-- /.blog-one__content -->
                            </div><!-- /.blog-one__single -->
                        </div><!-- /.col-lg-4 -->
                        <div class="col-lg-3">
                        <div class="blog-one__single">
                                <div class="blog-one__image">
                                    <img src="{{asset('assets/images/blog-1-1.jpg')}}" alt="">
                                    <a class="blog-one__plus" href="news-details.html"><i class="kipso-icon-plus-symbol"></i>
                                        <!-- /.kipso-icon-plus-symbol --></a>
                                </div><!-- /.blog-one__image -->
                                <div class="blog-one__content text-center">
                                    <div class="blog-one__meta">
                                        <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted On Jan 19"><i class="fa fa-calendar-alt"></i></a>
                                        
                                        <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted By Admin"><i class="fa fa-user"></i></a>
                                    </div><!-- /.blog-one__meta -->
                                    <h2 class="blog-one__title"><a href="news-details.html">اسم الفعالية</a>
                                    </h2><!-- /.blog-one__title -->
                                    <p class="blog-one__text">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p><!-- /.blog-one__text -->
                                    <a href="news-details.html" class="blog-one__link">المزيد</a><!-- /.blog-one__link -->
                                </div><!-- /.blog-one__content -->
                            </div><!-- /.blog-one__single -->   
                            
                            
                            
                        </div><!-- /.col-lg-4 -->
                    
                    
                    <div class="col-lg-3">
                        <div class="blog-one__single">
                                <div class="blog-one__image">
                                    <img src="{{asset('assets/images/blog-1-1.jpg')}}" alt="">
                                    <a class="blog-one__plus" href="news-details.html"><i class="kipso-icon-plus-symbol"></i>
                                        <!-- /.kipso-icon-plus-symbol --></a>
                                </div><!-- /.blog-one__image -->
                                <div class="blog-one__content text-center">
                                    <div class="blog-one__meta">
                                        <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted On Jan 19"><i class="fa fa-calendar-alt"></i></a>
                                        
                                        <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted By Admin"><i class="fa fa-user"></i></a>
                                    </div><!-- /.blog-one__meta -->
                                    <h2 class="blog-one__title"><a href="news-details.html">اسم الفعالية</a>
                                    </h2><!-- /.blog-one__title -->
                                    <p class="blog-one__text">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p><!-- /.blog-one__text -->
                                    <a href="news-details.html" class="blog-one__link">المزيد</a><!-- /.blog-one__link -->
                                </div><!-- /.blog-one__content -->
                            </div><!-- /.blog-one__single -->   
                            
                            
                            
                        </div><!-- /.col-lg-4 --> 
                    </div><!-- /.row -->
            
                </div><!-- /.container -->
            </section>
        </div>
    </div><!-- /.container -->
</section>
<!----------------Events-------->  

@endsection