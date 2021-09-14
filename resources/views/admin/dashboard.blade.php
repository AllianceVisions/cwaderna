@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12"> 
            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row" style="background: white;padding-top:30px"> 

                    <div class="{{ $chart1->options['column_class'] }}">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title mb-0">{{ trans('cruds.event.title') }}</h4>
                                <div class="small text-muted">{{date("F", mktime(0, 0, 0, $month_bar, 10))}} - {{$year_bar}}</div>
                            </div>
                            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                                <form action="" method="GET" id="form-line">
                                    <label class="btn btn-outline-secondary">
                                        <select class="form-control" name="year_bar" id="year_bar">
                                            @for($i = 2021 ; $i <= 2051 ; $i++)
                                                <option value="{{$i}}" @if($year_bar == "{{$i}}") selected @endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input type="submit" class="btn btn-info btn-rounded" value="fetch">
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <select class="form-control" name="month_bar" id="month_bar">
                                            <option value="1" @if($month_bar == "1") selected @endif>{{ __('january')}}</option>
                                            <option value="2" @if($month_bar == "2") selected @endif>{{ __('february')}}</option>
                                            <option value="3" @if($month_bar == "3") selected @endif>{{ __('march')}}</option>
                                            <option value="4" @if($month_bar == "4") selected @endif>{{ __('april')}}</option>
                                            <option value="5" @if($month_bar == "5") selected @endif>{{ __('may')}}</option>
                                            <option value="6" @if($month_bar == "6") selected @endif>{{ __('june')}}</option>
                                            <option value="7" @if($month_bar == "7") selected @endif>{{ __('july')}}</option>
                                            <option value="8" @if($month_bar == "8") selected @endif>{{ __('august')}}</option>
                                            <option value="9" @if($month_bar == "9") selected @endif>{{ __('september')}}</option>
                                            <option value="10" @if($month_bar == "10") selected @endif>{{ __('october')}}</option>
                                            <option value="11" @if($month_bar == "11") selected @endif>{{ __('november')}}</option>
                                            <option value="12" @if($month_bar == "12") selected @endif>{{ __('december')}}</option>
                                        </select>
                                    </label> 
                                </form>
                            </div>
                        </div>  
                        {!! $chart1->renderHtml() !!}
                    </div>

                    <div class="col-md-4"> 
                        <div class="card text-white bg-primary" style="position: relative">
                            <div style="position: absolute;@if(app()->getLocale() == 'ar') left:0 @else right:0 @endif">
                                <i style="font-size: 91px;color:#082a482e" class="fa-fw far fa-user c-sidebar-nav-icons"></i>
                            </div>
                            <div class="card-body pb-0">
                                <div class="text-value-lg">{{ trans('cruds.eventOrganizer.title') }}</div>
                                <div style="font-size: 20px">{{\App\Models\User::where('user_type','events_organizer')->get()->count()}} </div>
                                <br />
                            </div>
                        </div>
                        
                        <div class="card text-white bg-info" style="position: relative">
                            <div style="position: absolute;@if(app()->getLocale() == 'ar') left:0 @else right:0 @endif">
                                <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-medal c-sidebar-nav-icon"></i>
                            </div>
                            <div class="card-body pb-0">
                                <div class="text-value-lg">{{ trans('cruds.event.title') }}</div>
                                <div style="font-size: 20px">{{\App\Models\Event::get()->count()}}</div>
                                <br />
                            </div>
                        </div>
                        
                        <div class="card text-white bg-warning" style="position: relative">
                            <div style="position: absolute;@if(app()->getLocale() == 'ar') left:0 @else right:0 @endif">
                                <i style="font-size: 91px;color:#082a482e" class="fa-fw far fa-address-book c-sidebar-nav-icon"></i>
                            </div>
                            <div class="card-body pb-0">
                                <div class="text-value-lg">{{ trans('cruds.cader.title') }}</div>
                                <div style="font-size: 20px">{{\App\Models\User::where('user_type','cader')->get()->count()}}</div>
                                <br />
                            </div>
                        </div>
                        
                        <div class="card text-white bg-danger" style="position: relative">
                            <div style="position: absolute;@if(app()->getLocale() == 'ar') left:0 @else right:0 @endif">
                                <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-feather-alt c-sidebar-nav-icon"></i>
                            </div>
                            <div class="card-body pb-0">
                                <div class="text-value-lg">{{ trans('cruds.item.title') }}</div>
                                <div style="font-size: 20px">{{\App\Models\Item::get()->count()}}</div>
                                <br />
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}
@endsection