@extends('admin.layout.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            <div class="row">

                <div class="col-md-6">
                    {{-- event_organizer_id --}}
                    <div class="form-group">
                        <label class="required" for="event_organizer_id">{{ trans('cruds.event.fields.event_organizer_id') }}</label>
                        <select class="form-control select2 {{ $errors->has('event_organizer_id') ? 'is-invalid' : '' }}" name="event_organizer_id" id="event_organizer_id" required>
                            @foreach($event_organizers as $id => $entry)
                                <option value="{{ $id }}" {{ (old('event_organizer_id') ? old('event_organizer_id') : $event->event_organizer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('event_organizer_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('event_organizer_id') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.event_organizer_id_helper') }}</span>
                    </div>
                    {{-- title --}}
                    <div class="form-group">
                        <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
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

                    {{-- <button onclick="getLocation()" type="button">Try It</button>

                    <div id="mapholder"></div> --}}
                </div>

                <div class="col-md-6">
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
<script>
    Dropzone.options.photoDropzone = {
        url: '{{ route('admin.events.storeMedia') }}',
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