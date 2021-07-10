<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show" style="background: white">

    <div class="c-sidebar-brand d-md-down-none"> 
        <a class="c-sidebar-brand-full h4" href="#">
            <img src="{{asset('assets/images/logo-dark.png')}}" class="main-logo" width="128" alt="Awesome Image" />
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt" style="color: #922B21">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>   

        @can('cader_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/caders*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-id-card c-sidebar-nav-icon" style="color: #922B21">

                    </i>
                    {{ trans('cruds.caderManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('cader_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.caders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/caders") || request()->is("admin/caders/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-address-book c-sidebar-nav-icon" style="color:#34495E">

                                </i>
                                {{ trans('cruds.cader.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        
        @can('event_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/event-organizers*") ? "c-show" : "" }} {{ request()->is("admin/events*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-location-arrow c-sidebar-nav-icon" style="color: #922B21">

                    </i>
                    {{ trans('cruds.eventManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('event_organizer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.event-organizers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/event-organizers") || request()->is("admin/event-organizers/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-user c-sidebar-nav-icon" style="color:#34495E">

                                </i>
                                {{ trans('cruds.eventOrganizer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('event_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.events.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-medal c-sidebar-nav-icon" style="color: #34495E">

                                </i>
                                {{ trans('cruds.event.title') }}
                            </a>
                        </li>
                    @endcan
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                            <i class="c-sidebar-nav-icon fa-fw fas fa-calendar" style="color: #34495E">
            
                            </i>
                            {{ trans('global.systemCalendar') }}
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        
        @can('provider_man_mangment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/categories*") ? "c-show" : "" }} {{ request()->is("admin/provider-men*") ? "c-show" : "" }} {{ request()->is("admin/items*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fab fa-servicestack c-sidebar-nav-icon" style="color: #922B21">

                    </i>
                    {{ trans('cruds.providerManMangment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('provider_man_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.provider-men.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/provider-men") || request()->is("admin/provider-men/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-astronaut c-sidebar-nav-icon"  style="color:#34495E">

                                </i>
                                {{ trans('cruds.providerMan.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tasks c-sidebar-nav-icon"  style="color:#34495E">

                                </i>
                                {{ trans('cruds.category.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('item_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.items.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/items") || request()->is("admin/items/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-feather-alt c-sidebar-nav-icon"  style="color:#34495E">

                                </i>
                                {{ trans('cruds.item.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        
        @can('user_alert_access')
            <li class="c-sidebar-nav-item" style="color:#5499C7">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon" style="color:#922B21">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon" style="color: #922B21">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        {{-- <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li> --}}
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon" style="color:#34495E">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon" style="color: #34495E">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon" style="color: #34495E">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        
        @can('setting_access')
            <li class="c-sidebar-nav-dropdown  {{ request()->is("admin/cities*") ? "c-show" : "" }} {{ request()->is("admin/skills*") ? "c-show" : "" }} {{ request()->is("admin/specializations/*") ? "c-active" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon" style="color: #922B21">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('city_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe-africa c-sidebar-nav-icon" style="color: #34495E">
            
                                </i>
                                {{ trans('cruds.city.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('specialization_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.specializations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/specializations") || request()->is("admin/specializations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-glasses c-sidebar-nav-icon" style="color: #34495E">

                                </i>
                                {{ trans('cruds.specialization.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('skill_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.skills.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/skills") || request()->is("admin/skills/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-award c-sidebar-nav-icon" style="color: #34495E">
            
                                </i>
                                {{ trans('cruds.skill.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt" style="color: #922B21">

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