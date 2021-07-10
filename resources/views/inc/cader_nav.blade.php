<header class="c-header c-header-fixed px-3" style="border:1px">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="fas fa-fw fa-bars"></i>
    </button>

    <a class="c-header-brand d-lg-none" href="#">
        كوادرنا
    </a>

    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="fas fa-fw fa-bars"></i>
    </button>

    <ul class="c-header-nav @if(app()->getLocale() == 'ar') mr-auto @else ml-auto @endif">
        
        <li class="c-header-nav-item">
            <a href="{{route('frontend.home')}}" class="c-header-nav-link">
                {{trans('global.homepage')}} &nbsp;
                <i class="fa fa-home"></i>
            </a>
        </li>

        @if(count(config('panel.available_languages', [])) > 1)
            <li class="c-header-nav-item dropdown d-md-down-none">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach(config('panel.available_languages') as $langLocale => $langName)
                        <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                    @endforeach
                </div>
            </li>
        @endif

        <ul class="c-header-nav ml-auto">
            <li class="c-header-nav-item dropdown notifications-menu">
                <a href="#" class="c-header-nav-link" data-toggle="dropdown">
                    <i class="far fa-bell"></i>
                    @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                        @if($alertsCount > 0)
                            <span class="badge badge-warning navbar-badge">
                                {{ $alertsCount }}
                            </span>
                        @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                        @foreach($alerts as $alert)
                            <div class="dropdown-item">
                                <a href="{{ $alert->alert_link ? $alert->alert_link : "#" }}" target="_blank" rel="noopener noreferrer">
                                    @if($alert->pivot->read === 0) <strong> @endif
                                        {{ $alert->alert_text }}
                                        @if($alert->pivot->read === 0) </strong> @endif
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center">
                            {{ trans('global.no_alerts') }}
                        </div>
                    @endif
                </div>
            </li>

            <li class="c-header-nav-item dropdown d-md-down-none" style=" background: #EBEDEF; border-radius: 8px 39px 0px 0px; padding: 0px 13px;">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @if(auth()->user()->photo)
                        <img src="{{asset(auth()->user()->photo->getUrl('thumb'))}}" alt="" width="40" height="40" style="border-radius: 50px;margin:10px">
                    @else 
                        <img src="{{asset('user.png')}}" alt="" width="40" height="40" style="border-radius: 50px;margin:10px">
                    @endif
                    <span class="text-center"> 
                        {{auth()->user()->first_name . " " . auth()->user()->last_name }}
                        <br> 
                        <small style="background: #922B21;color:#fff; border-radius: 30px; padding: 1px 11px;">{{trans('global.user_type.'.auth()->user()->user_type)}}</small> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right"> 
                    <a class="dropdown-item" href="{{route('cader.profile.edit')}}">{{trans('global.profile')}}</a> 
                    <a class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logoutform').submit();"> {{ trans('global.logout') }}</a> 
                </div>
            </li>
    
        </ul>

    </ul> 
</header>