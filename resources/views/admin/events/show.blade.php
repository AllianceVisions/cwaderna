@extends('layouts.admin')

@section('styles')
    <style>
        .nav-tabs .nav-item .nav-link {
            padding: 12px;
            color: #5D6D7E
        }
    </style>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body"> 
        <div class="form-group">  

            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        </div> 
                    </div>
                </div>
            </div>  
            
            <!-- Modal attendance cader -->
            <div class="modal fade bd-example-modal-lg" id="attendance_modal" tabindex="1" role="dialog" aria-labelledby="attendance_modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="attendance_modalLabel">{{trans('cruds.event.others.attendance_in_event')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                            <div id="attendance_cader"></div> 
                        </div> 
                    </div>
                </div>
            </div>

            <!-- Modal add service -->
            <div class="modal fade" id="add_service_modal" tabindex="1" role="dialog" aria-labelledby="add_service_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_service_modalLabel">{{trans('cruds.event.others.add_service_in_event')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.events.add_item')}}" method="POST" id="add_service_form">
                                @csrf 

                                <input type="hidden" value="{{$event->id}}" name="event_id"> 
                                {{-- services --}} 
                                <div class="form-group">
                                    <label class="required" for="item_id">{{ trans('cruds.item.title_singular') }}</label>
                                    <select class="form-control select2 {{ $errors->has('item_id') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
                                        @foreach(\App\Models\Item::orderBy('created_at','desc')->get() as $item)
                                            <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('item_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('item_id') }}
                                        </div>
                                    @endif 
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- profit --}}
                                        <div class="form-group">
                                            <label class="required" for="profit">{{ trans('cruds.event.others.profit_service') }}</label>
                                            <input class="form-control {{ $errors->has('profit') ? 'is-invalid' : '' }}" type="number" name="profit" id="profit_modal" value="{{ old('profit') }}" required>
                                            @if($errors->has('profit'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('profit') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- price --}}
                                        <div class="form-group">
                                            <label class="required" for="price">{{ trans('cruds.event.others.price') }}</label>
                                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price_modal" value="{{ old('price') }}" required>
                                            @if($errors->has('price'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('price') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- start_attendance --}}
                                        <div class="form-group">
                                            <label class="required" for="start_attendance">{{ trans('cruds.event.fields.start_attendance') }}</label>
                                            <input class="form-control datetime {{ $errors->has('start_attendance') ? 'is-invalid' : '' }}" type="text" name="start_attendance" id="start_attendance_modal" value="{{ old('start_attendance') }}" required>
                                            @if($errors->has('start_attendance'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('start_attendance') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- end_attendance --}}
                                        <div class="form-group">
                                            <label class="required" for="end_attendance">{{ trans('cruds.event.fields.end_attendance') }}</label>
                                            <input class="form-control datetime {{ $errors->has('end_attendance') ? 'is-invalid' : '' }}" type="text" name="end_attendance" id="end_attendance_modal" value="{{ old('end_attendance') }}" required>
                                            @if($errors->has('end_attendance'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('end_attendance') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">{{trans('global.save')}}</button>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>

            <!-- Modal edit service -->
            <div class="modal fade" id="edit_service_modal" tabindex="1" role="dialog" aria-labelledby="edit_service_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_service_modalLabel">{{trans('cruds.event.others.edit_service_in_event')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.events.update_item')}}" method="POST" id="edit_service_form">
                                @csrf 

                                <input type="hidden" value="{{$event->id}}" name="event_id"> 
                                <input type="hidden" value="" name="item_id" id="item_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- profit --}}
                                        <div class="form-group">
                                            <label class="required" for="profit">{{ trans('cruds.event.others.profit_service') }}</label>
                                            <input class="form-control {{ $errors->has('profit') ? 'is-invalid' : '' }}" type="number" name="profit" id="profit_modal" value="{{ old('profit') }}" required>
                                            @if($errors->has('profit'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('profit') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- price --}}
                                        <div class="form-group">
                                            <label class="required" for="price">{{ trans('cruds.event.others.price') }}</label>
                                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price_modal" value="{{ old('price') }}" required>
                                            @if($errors->has('price'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('price') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- start_attendance --}}
                                        <div class="form-group">
                                            <label class="required" for="start_attendance">{{ trans('cruds.event.fields.start_attendance') }}</label>
                                            <input class="form-control datetime {{ $errors->has('start_attendance') ? 'is-invalid' : '' }}" type="text" name="start_attendance" id="start_attendance_modal" value="{{ old('start_attendance') }}" required>
                                            @if($errors->has('start_attendance'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('start_attendance') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- end_attendance --}}
                                        <div class="form-group">
                                            <label class="required" for="end_attendance">{{ trans('cruds.event.fields.end_attendance') }}</label>
                                            <input class="form-control datetime {{ $errors->has('end_attendance') ? 'is-invalid' : '' }}" type="text" name="end_attendance" id="end_attendance_modal" value="{{ old('end_attendance') }}" required>
                                            @if($errors->has('end_attendance'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('end_attendance') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">{{trans('global.save')}}</button>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>

            <div> 
                @if($event->status != 'pending') 
                    @if($event->status == 'request_to_pricing')
                        <a href="{{ route('admin.events.send_pricing',$event->id) }}" class="btn btn-danger mb-3">{{ trans('cruds.event.others.send_price') }}</a>
                    @elseif($event->status == 'pending_owner_accept') 
                        <button class="btn btn-danger mb-3" disabled>{{trans('global.event_status.pending_owner_accept')}}</button>
                    @elseif($event->status == 'accepted')
                        <button class="btn btn-success mb-3" disabled>{{trans('global.event_status.accepted')}}</button>
                    @elseif($event->status == 'refused')
                        <button class="btn btn-warning text-white mb-3" disabled>{{trans('global.event_status.refused')}}</button>
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
                    @if($event->status != 'pending')   
                        <div class="partials-scrollable" style="max-height: 450px" id="event_caders">
                            @includeIf('admin.events.caders.caders', ['event' => $event])
                        </div>
                    @else 
                        <div class="alert alert-warning">بانتظار الأرسال من المنظم</div>
                    @endif
                </div>
                <div class="tab-pane fade @isset($relation_tab) show active @endisset" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab">
                    @if($event->status != 'pending')   
                        <div class="partials-scrollable " style="max-height: 450px" id="event_services">
                            @includeIf('admin.events.services.services', ['event' => $event])
                        </div>
                    @else 
                        <div class="alert alert-warning">بانتظار الأرسال من المنظم</div>
                    @endif
                </div>
            </div>

            <div class="form-group mt-3">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
@parent
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCq2UTcMzYp__KQb0P_By0dmzCjP9Twors&libraries=places&v=weekly"></script>
<script>

    let infoObj = []; 
    let map ; 
    let titles = [];
    let markers = [];

    function myMap3() {
        var mapCanvas = document.getElementById("map3");
        var mapOptions = {
            center: new google.maps.LatLng('{{ $event->latitude}}', '{{ $event->longitude }}'),
            zoom: 14,
            mapTypeId: "roadmap",
        };
        map = new google.maps.Map(mapCanvas, mapOptions);

        var circle = new google.maps.Circle({
            center:new google.maps.LatLng('{{ $event->latitude}}', '{{ $event->longitude }}'), 
            radius: parseInt('{{ $event->area}}'), 
            fillColor: "#0000FF", 
            fillOpacity: 0.3, 
            map: map, 
            strokeColor: "#FFFFFF", 
            strokeOpacity: 0.6, 
            strokeWeight: 2
        });
        @foreach($event->caders()->wherePivot('status','accepted')->get() as $cader) 
            titles.push({
                'id' : '{{ $cader->user_id }}',
                'lat' : '{{ $cader->latitude}}',
                'lng' : '{{ $cader->longitude}}',
                'name' : '{{ $cader->user->first_name}}' + ' ' + '{{ $cader->user->last_name}}',
                'photo' : '{{ str_replace("public/public","public",asset($cader->user->photo->getUrl("thumb"))) }}'
            });
        @endforeach
        
        for(var i = 0; i < parseInt('{{ $event->caders()->get()->count() }}') ; i++){ 
            var contentString = '<img style="padding:8px" src="' + titles[i].photo + '"> <h5>' + titles[i].name + '</h5> '; 

            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(titles[i].lat, titles[i].lng), 
                map:map,
                title:titles[i].id, 
            });

            const infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200,
            });

            marker.addListener("click", function(){
                closeOtherInfo();
                infowindow.open(map,marker);
                infoObj[0] = infowindow;
            }); 
            markers.push(marker);
        }
    }
    google.maps.event.addDomListener(window, 'load', myMap3); 
    function functiontofindIndexByKeyValue(arraytosearch, key, valuetosearch) {

        for (var i = 0; i < arraytosearch.length; i++) {

            if (arraytosearch[i][key] == valuetosearch) {
                return i;
            }
        }
        return null;
    } 

    function zoomInMap(lat,lng){
        var pt = new google.maps.LatLng(lat, lng);
        map.setCenter(pt);
        map.setZoom(18);
    }
    function closeOtherInfo(){
        if(infoObj.length > 0){
            infoObj[0].set('marker',null);
            infoObj[0].close();
            infoObj[0].length = 0; 
        }
    }
    function addmarker(lat,lng,title = ''){
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
            circles[i].setMap(null);
        }

        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat,lng), 
            map,
            title: title,
        });
        markers.push(marker);
        
        var circle = new google.maps.Circle({
            center:new google.maps.LatLng(lat,lng), 
            radius: parseInt($('#area').val()), 
            fillColor: "#0000FF", 
            fillOpacity: 0.2, 
            map: map, 
            strokeColor: "#FFFFFF", 
            strokeOpacity: 0.6, 
            strokeWeight: 2
        });
        circles.push(circle);
    }
</script>

<script>
    var channel = pusher.subscribe('stream-location');

    channel.bind('App\\Events\\ChangeLocation',function(obj){ 
        
        var index = functiontofindIndexByKeyValue(markers, "title", obj['user_id']);
        
        markers[index].setPosition(new google.maps.LatLng(obj['latitude'], obj['longitude']))
        if(obj['alert_out_of_zone'] == 1){
            var title = 'خارج نطاق الفعالية';
            var message = 'الكادر ' + obj['name'];
            showFrontendAlert('warning', title, message);
        }

        if(obj['refresh'] == 1){
            $.post('{{ route('admin.events.refresh_caders_list') }}', {
                _token: '{{ csrf_token() }}', 
                event_id: '{{ $event->id }}',
            }, function(data) {
                $('#caders_in_map').html(null);
                $('#caders_in_map').html(data);
            });
        }
    });
</script>

<script> 
    function add_cader(id,start_attendance,end_attendance,title){ 
        var errorContainer = '<div class="alert alert-danger" style="display: none" id="jquery-error">  </div>';

        $.post('{{ route('admin.events.partials.add_cader') }}', {
            _token: '{{ csrf_token() }}',
            specialize_id: id,
            start_attendance: start_attendance,
            end_attendance: end_attendance,
            event_id: '{{ $event->id }}',
        }, function(data) {
            $('#modal').modal('show');
            $('#modal .modal-title').html(title);
            $('#modal .modal-body').html(errorContainer + data);
        });
    }

    function edit_cader(price,profit,start_attendance,end_attendance,cader_id,title,specialize_id){
        
        var errorContainer = '<div class="alert alert-danger" style="display: none" id="jquery-error">  </div>';

        $.post('{{ route('admin.events.partials.edit_cader') }}', {
            _token: '{{ csrf_token() }}',
            price: price,
            start_attendance: start_attendance,
            end_attendance: end_attendance,
            profit: profit,
            cader_id: cader_id,
            specialize_id: specialize_id,
            event_id: '{{ $event->id }}',
        }, function(data) {
            $('#modal').modal('show');
            $('#modal .modal-title').html(title);
            $('#modal .modal-body').html(errorContainer + data);
        }); 
    }

    function add_item(){
        $('#add_service_modal').modal('show');
    }
    function showmodal3(price,profit,start_attendance,end_attendance,item_id){
        $('#edit_service_modal').modal('show')
        $('#edit_service_modal #start_attendance_modal').val(null);
        $('#edit_service_modal #start_attendance_modal').val(start_attendance);
        $('#edit_service_modal #end_attendance_modal').val(null);
        $('#edit_service_modal #end_attendance_modal').val(end_attendance);
        $('#edit_service_modal #price_modal').val(null);
        $('#edit_service_modal #price_modal').val(price);
        $('#edit_service_modal #profit_modal').val(null);
        $('#edit_service_modal #profit_modal').val(profit); 
        $('#edit_service_modal #item_id').val(null);
        $('#edit_service_modal #item_id').val(item_id); 
    }

    function showmodal4(cader_id){
        $('#attendance_modal').modal('show') 
        $.post('{{ route('admin.events.partials.attendance_cader') }}', {_token:'{{ csrf_token() }}', cader_id:cader_id,event_id:'{{$event->id}}'}, function(data){
            $('#attendance_cader').html(null);
            $('#attendance_cader').html(data);
        });
    } 
</script>
@endsection
