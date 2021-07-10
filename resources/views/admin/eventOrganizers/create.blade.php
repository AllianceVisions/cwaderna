@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.event-organizers.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    {{-- first_name && last_name --}}
                    <div class="row">
                        
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="first_name">{{ trans('cruds.user.fields.first_name') }}</label>
                                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                                @if($errors->has('first_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('first_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.first_name_helper') }}</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                                @if($errors->has('last_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                            </div>
                        </div>
                    </div>
        
                    {{-- email && password --}}
                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', '') }}" required>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                            </div>
                        </div>
                    </div>
        
                    {{-- city_id --}}
                    <div class="row"> 
                        
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="city_id">{{ trans('cruds.user.fields.city_id') }}</label>
                                <select class="form-control select2 {{ $errors->has('city_id') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                                    @foreach($cities as $id => $name)
                                        <option value="{{ $id }}"  {{ old('city_id','') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('city_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city_id') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.city_id_helper') }}</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required">{{ trans('cruds.user.fields.gender') }}</label>
                                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\User::GENDER_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('gender') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
                            </div>
                        </div>
                    </div> 
                    {{-- identity_num && nationality_id --}}
                    <div class="row">
                        
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="identity_num">{{ trans('cruds.user.fields.identity_num') }}</label>
                                <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="text" name="identity_num" id="identity_num" value="{{ old('identity_num', '') }}" required>
                                @if($errors->has('identity_num'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('identity_num') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.identity_num_helper') }}</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="nationality_id">{{ trans('cruds.user.fields.nationality_id') }}</label>
                                <select class="form-control select2 {{ $errors->has('nationality_id') ? 'is-invalid' : '' }}" name="nationality_id" id="nationality_id" required>
                                    @foreach($nationalites as $id => $name)
                                        <option value="{{ $id }}"  {{ old('nationality_id','') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('nationality_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nationality_id') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.nationality_id_helper') }}</span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="photo">{{ trans('cruds.user.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                        </div>
                        @if($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
                    </div>
                </div>

                <div class="col-md-6"> 

                    {{-- phone  --}}
                    <div class="row">
                        
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                            </div>
                        </div>
                        

                    </div> 

                    <div class="form-group">
                        <label class="required" for="company_name">{{ trans('cruds.eventOrganizer.fields.company_name') }}</label>
                        <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                        @if($errors->has('company_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.eventOrganizer.fields.company_name_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="commerical_reg">{{ trans('cruds.eventOrganizer.fields.commerical_reg') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('commerical_reg') ? 'is-invalid' : '' }}" id="commericalreg-dropzone">
                        </div>
                        @if($errors->has('commerical_reg'))
                            <div class="invalid-feedback">
                                {{ $errors->first('commerical_reg') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.eventOrganizer.fields.commerical_reg_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="identity">{{ trans('cruds.eventOrganizer.fields.identity') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('identity') ? 'is-invalid' : '' }}" id="identity-dropzone">
                        </div>
                        @if($errors->has('identity'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identity') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.eventOrganizer.fields.identity_helper') }}</span>
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
        url: '{{ route('admin.event-organizers.storeMedia') }}',
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
    @if(isset($eventOrganizer->user) && $eventOrganizer->user->photo)
        var file = {!! json_encode($eventOrganizer->user->photo) !!}
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

<script>
    Dropzone.options.identityDropzone = {
        url: '{{ route('admin.event-organizers.storeMedia') }}',
        maxFilesize: 2, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2
        },
        success: function (file, response) {
        $('form').find('input[name="identity"]').remove()
        $('form').append('<input type="hidden" name="identity" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="identity"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
    @if(isset($cader->user) && $cader->user->identity)
        var file = {!! json_encode($cader->user->identity) !!}
            this.options.addedfile.call(this, file)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="identity" value="' + file.file_name + '">')
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

<script>
    Dropzone.options.commericalregDropzone = {
        url: '{{ route('admin.event-organizers.storeMedia') }}',
        maxFilesize: 2, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2
        },
        success: function (file, response) {
        $('form').find('input[name="commerical_reg"]').remove()
        $('form').append('<input type="hidden" name="commerical_reg" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="commerical_reg"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
    @if(isset($cader->user) && $cader->user->commerical_reg)
        var file = {!! json_encode($cader->user->commerical_reg) !!}
            this.options.addedfile.call(this, file)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="commerical_reg" value="' + file.file_name + '">')
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