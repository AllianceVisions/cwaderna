@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.generalSettings.title') }}
    </div>


    <div class="card-body">
        <form method="POST" action="{{ route("admin.general-settings.update", [$general_settings->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row">
                <div class="col-md-6">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="site_name">{{ trans('cruds.generalSettings.fields.site_name') }}</label>
                                <input class="form-control {{ $errors->has('site_name') ? 'is-invalid' : '' }}" type="text" name="site_name" id="site_name" value="{{ old('site_name', $general_settings->site_name) }}" required>
                                @if($errors->has('site_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('site_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.generalSettings.fields.site_name_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="email">{{ trans('cruds.generalSettings.fields.email') }}</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $general_settings->email) }}" required>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.generalSettings.fields.email_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="phone">{{ trans('cruds.generalSettings.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $general_settings->phone) }}" required>
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.generalSettings.fields.phone_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="address">{{ trans('cruds.generalSettings.fields.address') }}</label>
                                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $general_settings->address) }}" required>
                                @if($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.generalSettings.fields.address_helper') }}</span>
                            </div>
                        </div>
                    </div> 
                    {{-- logo --}}
                    <div class="form-group">
                        <label for="logo">{{ trans('cruds.generalSettings.fields.logo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                        </div>
                        @if($errors->has('logo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('logo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.generalSettings.fields.logo_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="who_are_we">{{ trans('cruds.generalSettings.fields.who_are_we') }}</label>
                                <textarea class="form-control {{ $errors->has('who_are_we') ? 'is-invalid' : '' }}" name="who_are_we" id="who_are_we" required>{{ old('who_are_we', $general_settings->who_are_we) }}</textarea>
                                @if($errors->has('who_are_we'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('who_are_we') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.generalSettings.fields.who_are_we_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="our_goal">{{ trans('cruds.generalSettings.fields.our_goal') }}</label>
                                <textarea class="form-control {{ $errors->has('our_goal') ? 'is-invalid' : '' }}" name="our_goal" id="our_goal" required>{{ old('our_goal', $general_settings->our_goal) }}</textarea>
                                @if($errors->has('our_goal'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('our_goal') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.generalSettings.fields.our_goal_helper') }}</span>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="our_vision">{{ trans('cruds.generalSettings.fields.our_vision') }}</label>
                                <textarea class="form-control {{ $errors->has('our_vision') ? 'is-invalid' : '' }}" name="our_vision" id="our_vision" required>{{ old('our_vision', $general_settings->our_vision) }}</textarea>
                                @if($errors->has('our_vision'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('our_vision') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.generalSettings.fields.our_vision_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="our_message">{{ trans('cruds.generalSettings.fields.our_message') }}</label>
                                <textarea class="form-control {{ $errors->has('our_message') ? 'is-invalid' : '' }}" name="our_message" id="our_message" required>{{ old('our_message', $general_settings->our_message) }}</textarea>
                                @if($errors->has('our_message'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('our_message') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.generalSettings.fields.our_message_helper') }}</span>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            
            
            <div class="form-group">
                <button class="btn btn-warning btn-block text-white" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
@section('scripts')
@parent


<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.general-settings.storeMedia') }}',
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
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($general_settings) && $general_settings->logo)
      var file = {!! json_encode($general_settings->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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