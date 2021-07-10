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

                <div class="row">

                    <div class="col-md-3">
                        <div class="card text-white bg-primary" style="position: relative">
                            <div style="position: absolute;right:0">
                                <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-truck c-sidebar-nav-icon"></i>
                            </div>
                            <div class="card-body pb-0">
                                <div class="text-value-lg">#</div>
                                <div># </div>
                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info" style="position: relative">
                            <div style="position: absolute;right:0">
                                <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-building c-sidebar-nav-icon"></i>
                            </div>
                            <div class="card-body pb-0">
                                <div class="text-value-lg">#</div>
                                <div>#</div>
                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning" style="position: relative">
                            <div style="position: absolute;right:0">
                                <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-award c-sidebar-nav-icon"></i>
                            </div>
                            <div class="card-body pb-0">
                                <div class="text-value-lg">#</div>
                                <div>#</div>
                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger" style="position: relative">
                            <div style="position: absolute;right:0">
                                <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-gift c-sidebar-nav-icon"></i>
                            </div>
                            <div class="card-body pb-0">
                                <div class="text-value-lg">#</div>
                                <div>#</div>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!} --}}

@endsection