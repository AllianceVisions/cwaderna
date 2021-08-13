@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.slider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sliders.update", [$slider->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.slider.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $slider->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.event.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $slider->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="link">{{ trans('cruds.slider.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $slider->link) }}" required>
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slider">{{ trans('cruds.slider.fields.slider') }}</label>
                <div class="needsclick dropzone {{ $errors->has('slider') ? 'is-invalid' : '' }}" id="slider-dropzone">
                </div>
                @if($errors->has('slider'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slider') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.slider_helper') }}</span>
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
@parent


<script>
    Dropzone.options.sliderDropzone = {
    url: '{{ route('admin.sliders.storeMedia') }}',
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
      $('form').find('input[name="slider"]').remove()
      $('form').append('<input type="hidden" name="slider" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="slider"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($slider) && $slider->slider)
      var file = {!! json_encode($slider->slider) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="slider" value="' + file.file_name + '">')
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