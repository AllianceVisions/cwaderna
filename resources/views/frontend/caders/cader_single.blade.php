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
    
    .partials-scrollable{
        background: #80808017;
        padding: 20px;
        max-height: 300px;
        overflow: scroll;
    } 

    .partials-scrollable::-webkit-scrollbar {
        width: 5px;
    }

    .partials-scrollable::-webkit-scrollbar-track {
        background:rgba(0,0,0,.0); 
        border-radius: 10px;
    }

    .partials-scrollable::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: rgba(0,0,0,.3); 
    }
    .partials-scrollable::-webkit-scrollbar-thumb:hover {
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
                    <h3 class="team-details__subtitle">الدرجة العلمية : </h3>  
                    <div class="partials-scrollable">
                        @if($cader->user && $cader->user->academic_degree)
                            @foreach($cader->user->academic_degree as $raw)
                                {{$raw->university_name}}
                                <hr width="50%" style="margin: 7px 0px 14px 0px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="badge bg-info text-white" >{{ trans('cruds.academic_degree.fields.degree') }}</label>
                                        <span>{{ trans('global.academic_degree.degree.'.$raw->degree) }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="badge bg-secondary" >{{ trans('cruds.academic_degree.fields.start_date') }}</label>
                                        <span>{{$raw->start_date}}</span>

                                        <br>
                                        
                                        <label class="badge bg-secondary" >{{ trans('cruds.academic_degree.fields.end_date') }}</label>
                                        <span>{{$raw->end_date}}</span>
                                    </div> 
                                </div>
                            @endforeach
                        @endif
                    </div> 
                    <hr />
                    
                    <h3 class="team-details__subtitle">الخبرات السابقة</h3><!-- /.team-details__subtitle -->
                    
                    <div class="partials-scrollable">
                        @if($cader->user && $cader->user->previous_experience)
                            @foreach($cader->user->previous_experience as $raw)
                                {{$raw->company_name}}
                                <hr width="50%" style="margin: 7px 0px 14px 0px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="badge bg-info text-white" >{{ trans('cruds.previous_experience.fields.job_type') }}</label>
                                        <span>{{$raw->job_type}}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="badge bg-secondary text-white" >{{ trans('cruds.previous_experience.fields.start_date') }}</label>
                                        <span>{{$raw->start_date}}</span> 
                                        
                                        <label class="badge bg-secondary text-white" >{{ trans('cruds.previous_experience.fields.end_date') }}</label>
                                        <span>{{$raw->end_date}}</span>
                                    </div> 
                                </div>
                            @endforeach
                        @endif
                    </div> 
                        
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
            @foreach($cader->events()->where('events.status','accepted')->wherePivot('status','accepted')->get()->take(4) as $raw)
                <div class="col-lg-3">
                    <div class="blog-one__single">
                        <div class="blog-one__image">
                            @if($raw->photo)
                                <img src="{{ asset($event->photo->getUrl('thumb')) }}" alt=""> 
                            @else 
                                <img src="{{ asset('assets/images/blog-1-1.jpg')}}" alt=""> 
                            @endif
                                <!-- /.kipso-icon-plus-symbol --></a>
                        </div><!-- /.blog-one__image -->
                        <div class="blog-one__content text-center">
                            <div class="blog-one__meta">
                                <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Started at {{$raw->start_date}}"><i class="fa fa-calendar-alt"></i></a>
                                
                                <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Posted By {{\App\Models\EventOrganizer::find($raw->event_organizer_id)->company_name}}"><i class="fa fa-user"></i></a>
                            </div><!-- /.blog-one__meta -->
                            <h2 class="blog-one__title"><a href="news-details.html">{{$raw->title}}</a>
                            </h2><!-- /.blog-one__title -->
                            <p class="blog-one__text text-center">{{$raw->description}}</p><!-- /.blog-one__text -->
                        </div><!-- /.blog-one__content -->
                    </div><!-- /.blog-one__single -->
                </div><!-- /.col-lg-4 -->  
            @endforeach
        </div>
    </div><!-- /.container -->
</section>
<!----------------Events-------->  

@endsection