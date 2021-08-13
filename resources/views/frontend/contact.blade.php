@extends('layouts.frontend')
@section('content') 

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#">تواصل معنا</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">تواصل معنا</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<section class="contact-one">
    <div class="container">

        <form action="{{route('frontend.contactus.store')}}" method="POST" class="contact-one__form">
            @csrf
            <div class="row low-gutters">
                <div class="col-lg-6">
                    <input type="text" name="name" placeholder="الاسم ">
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <input type="email" name="email" placeholder="البريد الإلكتروني">
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-12">
                    <textarea placeholder="الرسالة" name="message"></textarea>
                    <div class="text-center">
                        <button type="submit" class="contact-one__btn thm-btn">إرسال</button>
                    </div><!-- /.text-center -->
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
        </form><!-- /.contact-one__form -->
    </div><!-- /.container -->
</section>

@endsection