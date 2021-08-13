@extends('layouts.frontend')
@section('content')

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#">منظمي الفعاليات</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">منظمي الفعاليات</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<section class="team-one team-page bg_custom_1507727948742">
    <div class="container">
        <div class="row">
            @foreach($eventorganizers as $organizer)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="team-one__single">
                        <div class="team-one__image">
                            @if($organizer->user->photo)
                                <img src="{{$organizer->user->photo->getUrl('thumb')}}" alt="">
                            @else 
                                <img src="{{asset('assets/images/team-1-1.jpg')}}" alt="">
                            @endif
                        </div><!-- /.team-one__image -->
                        <div class="team-one__content">
                            <h3 class="team-one__name"><a href="organizer_single.html">{{$organizer->company_name}}</a></h3>
                            <!-- /.team-one__name -->
                            <p class="team-one__designation">{{ $organizer->user->first_name . " " . $organizer->user->last_name}}</p><!-- /.team-one__designation -->
                                <p class="team-one__text"> <span><i class="fab fa-staylinked" aria-hidden="true"></i></span>  شارك في {{$organizer->events_count}} فعالية </p>

                            <a href="organizer_single.html" class="course-one__link">المزيد</a>
                            <!-- /.team-one__text -->
                        </div><!-- /.team-one__content --> 
                    </div><!-- /.team-one__single -->
                </div><!-- /.col-lg-3 -->
            @endforeach
        </div><!-- /.row -->
        <div class="post-pagination">
            {{ $eventorganizers->links('vendor.pagination.bootstrap-4') }}
        </div> 
    </div><!-- /.container -->
</section>

@endsection