@extends('layouts.frontend')
@section('content') 


    <section class="inner-banner">
        <div class="container">
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="#">الرئيسية</a></li>
                <li class="active"><a href="#">عن كوادرنا</a></li>
            </ul><!-- /.list-unstyled -->
            <h2 class="inner-banner__title">عن كوادرنا</h2><!-- /.inner-banner__title -->
        </div><!-- /.container -->
    </section>

    <div class="about">
        <div class="container"> 
            <div class="row about">
                <div class="col-md-3"> 
                    <img src="{{asset('assets/images/about.jpg')}}" class="img-fluid"> 
                </div> 
                <div class="col-md-9">
                    <div class="content">
                        <h3>من نحن </h3>
                            <p>
                                {{$general_settings->who_are_we}}
                            </p>
                        <br>
                        
                        <div class="abouticon"><i class="fas fa-comment-alt"></i></div>

                        <h3>أهدافنا</h3>
                            <p>
                                {{$general_settings->our_goal}}
                            </p>
                        <br>
                        
                        <div class="abouticon"><i class="fas fa-eye"></i></div>

                        <h3>رؤيتنا</h3>
                            <p>
                                {{$general_settings->our_vision}}
                            </p>
                        
                        <br>
                        
                        <div class="abouticon"><i class="fas fa-envelope"></i></div>

                        <h3>رسالتنا</h3>
                            <p>
                                {{$general_settings->our_message}}
                            </p>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
@endsection  