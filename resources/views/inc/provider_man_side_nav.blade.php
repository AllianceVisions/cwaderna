<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show" style="background: white">
    @php
        $general_settings = \App\Models\GeneralSettings::first();
    @endphp
    <div class="c-sidebar-brand d-md-down-none"> 
        <a class="c-sidebar-brand-full h4" href="#">
            @if($general_settings->logo)
                <img src="{{$general_settings->logo->getUrl()}}" class="main-logo" width="128" alt="{{$general_settings->site_name}}" />
            @else 
                <img src="{{asset('assets/images/logo-dark.png')}}" class="main-logo" width="128" alt="{{$general_settings->site_name}}" />
            @endif
        </a>
    </div>

    <ul class="c-sidebar-nav">

        <li class="c-sidebar-nav-item">
            <a href="{{ route("provider-man.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt" style="color: #2980B9">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="{{ route("provider-man.items.index") }}" class="c-sidebar-nav-link {{ request()->is("provider-man/items") || request()->is("provider-man/items/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-feather-alt c-sidebar-nav-icon" style="color: #2980B9">

                </i>
                {{ trans('cruds.item.title') }}
            </a>
        </li> 

        <li class="c-sidebar-nav-item">
            <a href="{{ route("provider-man.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("provider-man/orders") || request()->is("provider-man/orders/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-gift c-sidebar-nav-icon" style="color: #2980B9">

                </i>
                {{ trans('cruds.orders.title') }}
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt" style="color: #2980B9">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>

<div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                ##
            </div>
        </div>
    </div>
</div>