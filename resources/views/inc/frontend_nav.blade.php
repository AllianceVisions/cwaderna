<div class="topbar-one">
    <div class="container">
        <div class="topbar-one__left">
            <a href="#"><i class="fas fa-envelope"></i> needhelp@saudievents.com</a>
            <a href="#"><i class="fas fa-phone-alt"></i> 966 888 0000</a>
        </div><!-- /.topbar-one__left -->
        <div class="topbar-one__right hidden-xs">
            @auth 
            <?php
                if(auth()->user()->user_type == 'staff'){
                    $type = 'admin';
                }elseif(auth()->user()->user_type == 'events_organizer'){
                    $type = 'events-organizer';
                }elseif(auth()->user()->user_type == 'provider_man'){
                    $type = 'provider-man';
                }else{
                    $type = 'admin';
                }
            ?>
                    <a href="{{route($type.'.home')}}"><i class="far fa-user"></i> لوحة التحكم</a>
                    <a onclick="event.preventDefault(); document.getElementById('logoutform').submit();" href="#">
                        <i class="fa fa-sign-out"></i>تسجيل الخروج
                    </a>
            @else 
                <a href="{{route('login')}}"><i class="far fa-user"></i> دخول</a>
                <a href="{{route('caders.register')}}"><i class="fas fa-user-plus"></i> مستخدم جديد</a>
            @endauth
        </div><!-- /.topbar-one__right -->
    </div><!-- /.container -->
</div><!-- /.topbar-one -->

<header class="site-header site-header__header-one">
    <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
        <div class="container clearfix">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="logo-box clearfix">
                <a class="navbar-brand" href="{{route('frontend.home')}}">
                    <img src="{{asset('assets/images/logo-dark.png')}}" class="main-logo" width="128" alt="Awesome Image" />
                </a>
            
                <button class="menu-toggler" data-target=".main-navigation">
                    <span class="kipso-icon-menu"></span>
                </button>
            </div><!-- /.logo-box -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="main-navigation">
                <ul class=" navigation-box">
                    <li class="{{ request()->is("/") || request()->is("/") ? "current" : "" }}">
                        <a href="{{route('frontend.home')}}">الرئيسية</a>    
                    </li>
                    @auth
                        @if(Auth::user()->user_type == 'events_organizer')
                            <li class="{{ request()->is("my_list") || request()->is("my_list") ? "current" : "" }}">
                                <a href="{{route('frontend.my_list')}}">فعالياتي</a>    
                            </li>
                        @endif
                    @endauth
                    <li> 
                        <li class="{{ request()->is("cwaders") || request()->is("cwaders") ? "current" : "" }}"> 
                            <a href="{{route('frontend.cwaders')}}">كوادرنا</a> 
                        </li>
                
                        <li class="{{ request()->is("organizers") || request()->is("organizers") ? "current" : "" }}">  
                            <a href="{{route('frontend.organizers')}}">منظمي الفعاليات</a>   
                        </li>
                    </li>
                    <li>
                        <a href="{{route('frontend.services')}}">الخدمات</a>
                        <ul class="sub-menu">
                            <li class="{{ request()->is("services") || request()->is("services") ? "current" : "" }}">
                                <a href="{{route('frontend.services')}}">تحضير</a>
                            </li>
                            <li class="{{ request()->is("services") || request()->is("services") ? "current" : "" }}">
                                <a href="{{route('frontend.services')}}">تاهيل</a>
                            </li>
                            <li class="{{ request()->is("services") || request()->is("services") ? "current" : "" }}">
                                <a href="{{route('frontend.services')}}">متابعة</a>
                            </li>
                        </ul><!-- /.sub-menu --> 
                    </li> 
                    <li class="{{ request()->is("tickets") || request()->is("tickets") ? "current" : "" }}">
                        <a href="{{route('frontend.tickets')}}">التذاكر</a> 
                    </li>
                    <li class="{{ request()->is("aboutus") || request()->is("aboutus") ? "current" : "" }}">
                        <a href="{{route('frontend.aboutus')}}">من نحن</a> 
                    </li>
                    <li class="{{ request()->is("contact") || request()->is("contact") ? "current" : "" }}">
                        <a href="{{route('frontend.contact')}}">تواصل معنا</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
            <div class="right-side-box">
                <a class="header__search-btn search-popup__toggler" href="#"><i class="kipso-icon-magnifying-glass"></i>
                    <!-- /.kipso-icon-magnifying-glass --></a>
            </div><!-- /.right-side-box -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="site-header__decor">
        <div class="site-header__decor-row">
            <div class="site-header__decor-single">
                <div class="site-header__decor-inner-1"></div><!-- /.site-header__decor-inner -->
            </div><!-- /.site-header__decor-single -->
            <div class="site-header__decor-single">
                <div class="site-header__decor-inner-2"></div><!-- /.site-header__decor-inner -->
            </div><!-- /.site-header__decor-single -->
            <div class="site-header__decor-single">
                <div class="site-header__decor-inner-3"></div><!-- /.site-header__decor-inner -->
            </div><!-- /.site-header__decor-single -->
            <div class="site-header__decor-single">
                <div class="site-header__decor-inner-4"></div><!-- /.site-header__decor-inner -->
            </div>
            <!-- /.site-header__decor-single -->
            <div class="site-header__decor-single">
                <div class="site-header__decor-inner-5"></div><!-- /.site-header__decor-inner -->
            </div><!-- /.site-header__decor-single -->
            <!-- /.site-header__decor-single -->
            <div class="site-header__decor-single">
                <div class="site-header__decor-inner-6"></div><!-- /.site-header__decor-inner -->
            </div><!-- /.site-header__decor-single -->
        </div><!-- /.site-header__decor-row -->
    </div><!-- /.site-header__decor -->
</header><!-- /.site-header -->