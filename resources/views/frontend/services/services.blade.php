@extends('layouts.frontend')
@section('content')   

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#">خدماتنا</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">تحضير</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<div class="about">
    <div class="container">
        <div class="container p-50"> 
            <div class="row about">
                <div class="col-md-1 col-xs-12"></div>
                
                <div class="col-md-10 col-xs-12">
                <div class="content text-center">
                    
                    <img src="assets/images/competency-portfolio-learning.png">
                    
                    <p>
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم 
                        توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                        إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، 
                        النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص 
                        العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                        ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم 
                        ليظهر للعميل الشكل كاملاً،دور مولد
                        النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.
                    </p>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="contact-one__btn thm-btn" ><a href="{{route('frontend.services.request')}}">  طلب خدمة </a></button>
                    </div>
                
                </div>
                <div class="col-md-1 col-xs-12"></div>

            </div> 
        </div> 
    </div>
</div>

@endsection