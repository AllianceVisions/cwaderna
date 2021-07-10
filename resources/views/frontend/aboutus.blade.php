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
                        <p>فريق يمتلك العديد من الخبرات في عالم الترفيه والفعاليات نضيف لكل فعالية متعتها الخاصة نهتم بجودة الحدث وادارة التفاصيل الصغيرة عبر منصة متكاملة تتيح لكل مستفيد تلبية رغباته واحتياجاته بكل سهولةكوادرنا هي منصة إلكترونية سعودية تجمع لك كل الكوادر المدربه والمهئيه لجميع الأنشطة والفعاليات والدورات المقامة في مدينتك وتشارك معك في نجاح هذه الانشطه والفعاليات.</p>
                        
                        <br>
                        
                        <div class="abouticon"><i class="fas fa-comment-alt"></i></div>

                        <h3>أهدافنا</h3>
                        <p>ان نكون الجهه الرائده محلياً في تقديم وتأهيل وتدريب الكوادر الفعاله لجميع الانشطه والفعاليات  وبناء كوادر من المعرفه والتدريب في المستقبل.</p>
                        
                        <br>
                        
                        <div class="abouticon"><i class="fas fa-eye"></i></div>

                        <h3>رؤيتنا</h3>
                        <p>أن نكون المنصة  الرائدة في مجال إدارة الانشطه والفعاليات وجميع المحافل المحليه وتأهيل الكوادر لتلك الانشطه</p>
                        
                        <br>
                        
                        <div class="abouticon"><i class="fas fa-envelope"></i></div>

                        <h3>رسالتنا</h3>
                        <p>نحن في رحلة لتطوير مفهوم ادارة الانشطة والفعاليات بسواعد  كوادرنا من الشباب  واستكشاف شغفهم في هذا المجال</p>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
@endsection  