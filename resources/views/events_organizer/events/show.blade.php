@extends('layouts.events_organizer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('events-organizer.events.index') }}">
                    {{ trans('global.back_to_list') }}
                    
                </a>
            </div>

            
            <div> 
                @if($event->status != 'pending') 
                    @if($event->status == 'pending_owner_accept')
                        <a href="{{ route('events-organizer.events.change_status',['id' => $event->id,'status' => 'accepted']) }}" class="btn btn-success mb-3">الموافقة علي التسعيرة</a>
                        <a href="{{ route('events-organizer.events.change_status',['id' => $event->id,'status' => 'refused']) }}" class="btn btn-warning text-white mb-3">رفض التسعيرة</a>
                    @elseif($event->status == 'accepted')
                        <button class="btn btn-success mb-3" disabled>تم الموافقة</button>
                    @elseif($event->status == 'refused')
                        <button class="btn btn-warning text-white mb-3" disabled>تم الرفض</button>
                    @endif

                @endif
            </div> 

            <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @isset($relation_tab) @else active @endisset " id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="true">
                        <i class="fas fa-info-circle"></i>
                        {{ trans('cruds.event.others.info') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-map-tab" data-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map" aria-selected="false">
                        <i class="fas fa-map-marked-alt"></i>
                        {{ trans('cruds.event.others.map') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-caders-tab" data-toggle="pill" href="#pills-caders" role="tab" aria-controls="pills-caders" aria-selected="false">
                        <i class="fa-fw far fa-address-book"></i>
                        {{ trans('cruds.event.others.caders') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @isset($relation_tab) active @endisset" id="pills-services-tab" data-toggle="pill" href="#pills-services" role="tab" aria-controls="pills-services" aria-selected="false">
                        <i class="fas fa-tasks"></i>
                        {{ trans('cruds.event.others.services') }}
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade @isset($relation_tab) @else show active @endisset " id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
                    @includeIf('admin.events.partials.info', ['event' => $event])
                </div>
                <div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab"> 
                    <div class="row">
                        <div class="col-md-3">   
                            <div id="caders_in_map" class="partials-scrollable" style="max-height: 605px">
                                @includeIf('admin.events.partials.caders_map', ['event' => $event])
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">  
                                <div id="map3"  style="width: 100%; height: 600px"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-caders" role="tabpanel" aria-labelledby="pills-caders-tab">  
                    <div class="partials-scrollable" style="max-height: 450px" id="event_caders">
                        @includeIf('admin.events.caders.caders', ['event' => $event])
                    </div> 
                </div>
                <div class="tab-pane fade @isset($relation_tab) show active @endisset" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab"> 
                    <div class="partials-scrollable " style="max-height: 450px" id="event_services">
                        @includeIf('admin.events.services.services', ['event' => $event])
                    </div> 
                </div>
            </div>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('events-organizer.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
@parent
<script>  
    function showmodal4(cader_id){
        $('#attendance_modal').modal('show') 
        $.post('{{ route('events-organizer.events.partials.attendance_cader') }}', {_token:'{{ csrf_token() }}', cader_id:cader_id,event_id:'{{$event->id}}'}, function(data){
            $('#attendance_cader').html(null);
            $('#attendance_cader').html(data);
        });
    } 
</script>
@endsection
