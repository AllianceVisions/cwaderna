@extends('layouts.frontend')
@section('content')   

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active"><a href="#">التذاكر</a></li>
        </ul><!-- /.list-unstyled -->
        <h2 class="inner-banner__title">شراء التذاكر</h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<div class="tickets">
    <div class="container">
        <div class="buyticket">
            <form class="form-signin">        
                <div class="form-group">
                    <label>اختر الفعالية:</label>
                    <select class="form-control" id="sel1" placeholder="عنوان الفعالية"> 
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>اختر طريقة الدفع:</label>
                    <select class="form-control" id="sel1" placeholder="عنوان الفعالية"> 
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                
                <div class="clear"></div>
                <div class="text-center">
                    <button type="submit" class="contact-one__btn thm-btn" >  متابعة عملية الشراء</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection