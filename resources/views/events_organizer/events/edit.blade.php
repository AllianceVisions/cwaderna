@extends('layouts.events_organizer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("events-organizer.events.update", [$event->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <input type="hidden" name="event_organizer_id" value="{{$event->event_organizer_id}}">
            <input type="hidden" name="latitude" id="latitude" value="{{ $event->latitude ?? ''}}">
            <input type="hidden" name="longitude" id="longitude" value="{{ $event->longitude ?? ''}}">
            
            
            <div class="row">

                <div class="col-md-6">
                    <div class="row">  
                        {{-- title --}}
                        <div class="form-group col-md-12">
                            <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">  
                            {{-- city_id --}}
                            <div class="form-group">
                                <label class="required" for="city_id">{{ trans('cruds.event.fields.city_id') }}</label>
                                <select class="form-control select2 {{ $errors->has('city_id') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                                    @foreach($cities as $id => $name)
                                        <option value="{{ $id }}" @if($event->city_id == $id) selected @endif {{ old('city_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('city_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city_id') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.city_id_helper') }}</span>
                            </div> 
                        </div> 
                        <div class="col-md-4">
                            {{-- area --}}
                            <div class="form-group">
                                <label class="required" for="area">{{ trans('cruds.event.fields.area') }}</label>
                                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}"  type="number" step="0.00000001" name="area" id="area" value="{{ old('area', $event->area) }}" required>
                                @if($errors->has('area'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('area') }}
                                    </div>
                                @endif
                                <span class="help-block" style="font-size: 10px">{{ trans('cruds.event.fields.area_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- description --}}
                    <div class="form-group">
                        <label class="required" for="description">{{ trans('cruds.event.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $event->description) }}</textarea>
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                    </div>
                    {{-- conditions --}}
                    <div class="form-group">
                        <label class="required" for="conditions">{{ trans('cruds.event.fields.conditions') }}</label>
                        <textarea class="form-control {{ $errors->has('conditions') ? 'is-invalid' : '' }}" name="conditions" id="conditions" required>{{ old('conditions', $event->conditions) }}</textarea>
                        @if($errors->has('conditions'))
                            <div class="invalid-feedback">
                                {{ $errors->first('conditions') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.conditions_helper') }}</span>
                    </div>

                    <div class="partials-scrollable">
                        @include('admin.events.partials.specializations')
                    </div> 
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <input
                            style="width: 300px"
                            id="pac-input"
                            class="form-control"
                            type="text"
                            placeholder="Search Box"
                        />
                        <div id="map3"  style="width: 100%; height: 400px"></div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-6">
                            {{-- start_date --}}
                            <div class="form-group">
                                <label class="required" for="start_date">{{ trans('cruds.event.fields.start_date') }}</label>
                                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date',$event->start_date) }}" required>
                                @if($errors->has('start_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('start_date') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.start_date_helper') }}</span>
                            </div>
                            {{-- start_attendance --}}
                            <div class="form-group">
                                <label class="required" for="start_attendance">{{ trans('cruds.event.fields.start_attendance') }}</label>
                                <input class="form-control timepicker {{ $errors->has('start_attendance') ? 'is-invalid' : '' }}" type="text" name="start_attendance" id="start_attendance" value="{{ old('start_attendance',$event->start_attendance) }}" required>
                                @if($errors->has('start_attendance'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('start_attendance') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.start_attendance_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- end_date --}}
                            <div class="form-group">
                                <label class="required" for="end_date">{{ trans('cruds.event.fields.end_date') }}</label>
                                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $event->end_date) }}" required>
                                @if($errors->has('end_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('end_date') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.end_date_helper') }}</span>
                            </div>
                            {{-- end_attendance --}}
                            <div class="form-group">
                                <label class="required" for="end_attendance">{{ trans('cruds.event.fields.end_attendance') }}</label>
                                <input class="form-control timepicker {{ $errors->has('end_attendance') ? 'is-invalid' : '' }}" type="text" name="end_attendance" id="end_attendance" value="{{ old('end_attendance',$event->end_attendance) }}" required>
                                @if($errors->has('end_attendance'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('end_attendance') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.end_attendance_helper') }}</span>
                            </div>
                        </div>
                    </div> 

                    {{-- address --}}
                    <div class="form-group">
                        <label class="required" for="address">{{ trans('cruds.event.fields.address') }}</label>
                        <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address', $event->address) }}</textarea>
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.address_helper') }}</span>
                    </div> 
                    
                    {{-- photo --}} 
                    <div class="form-group">
                        <label class="required" for="photo">{{ trans('cruds.event.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                        </div>
                        @if($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.photo_helper') }}</span>
                    </div>

                </div>


            </div> 
            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCq2UTcMzYp__KQb0P_By0dmzCjP9Twors&libraries=places&v=weekly"></script>
<script>

    let markers = [];
    let circles = []; 
    let map ; 
    function myMap3() {
        var mapCanvas = document.getElementById("map3");
        var mapOptions = {
            center: new google.maps.LatLng('{{ $event->latitude}}', '{{ $event->longitude }}'),
            zoom: 14,
            mapTypeId: "roadmap",
        };
        map = new google.maps.Map(mapCanvas, mapOptions); 

        // Create the search box and link it to the UI element.
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            } 

            // For each place, get the icon, name and location.
            const bounds = new google.maps.LatLngBounds();

            places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                } 
                
                addmarker(place.geometry.location.lat(),place.geometry.location.lng());
                
                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        
        addmarker('{{ $event->latitude}}', '{{ $event->longitude }}'); 

        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => { 

            addmarker(mapsMouseEvent.latLng.lat(),mapsMouseEvent.latLng.lng());

            $('#latitude').val(mapsMouseEvent.latLng.lat());
            $('#longitude').val(mapsMouseEvent.latLng.lng());
        });
    }
    google.maps.event.addDomListener(window, 'load', myMap3); 

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
    Dropzone.options.photoDropzone = {
        url: '{{ route('events-organizer.events.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 2,
            width: 4096,
            height: 4096
        },
        success: function (file, response) {
            $('form').find('input[name="photo"]').remove()
            $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
            $('form').find('input[name="photo"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
        @if(isset($event) && $event->photo)
            var file = {!! json_encode($event->photo) !!}
                this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
        @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
@endsection