@extends('admin.layout.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cader.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.caders.store") }}" enctype="multipart/form-data">
            @csrf

            
            <div class="row mt-3">
                
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
        
                    
                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="national_id">{{ trans('cruds.user.fields.national_id') }}</label>
                                <input class="form-control {{ $errors->has('national_id') ? 'is-invalid' : '' }}" type="text" name="national_id" id="national_id" value="{{ old('national_id', '') }}" required>
                                @if($errors->has('national_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('national_id') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.national_id_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="required" for="nationality">{{ trans('cruds.user.fields.nationality') }}</label>
                                <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', '') }}" required>
                                @if($errors->has('nationality'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nationality') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.nationality_helper') }}</span>
                            </div>
                        </div>
                    </div> 

                    {{-- phone && gender --}}
                    <div class="row">
                        
                        <div class="col-md-6"> 
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

                    {{--  city_id && date_of_birth --}}
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
                                <label for="date_of_birth">{{ trans('cruds.user.fields.date_of_birth') }}</label>
                                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                                @if($errors->has('date_of_birth'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date_of_birth') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.date_of_birth_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="required" for="description">{{ trans('cruds.cader.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.cader.fields.description_helper') }}</span>
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

                    <div >
                        <label class="required">{{ trans('cruds.cader.fields.specializations') }}</label>
                        <hr width="70%" style="margin: 7px 0px 14px 0px;"> 
                        <div class="form-group"> 
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]" id="specializations" multiple>
                                @php $name = 'name_'.app()->getLocale();@endphp
                                @foreach($specializations as $specialize)
                                    <option value="{{ $specialize->id }}"  {{ in_array($specialize->id, old('specializations', [])) ? 'selected' : '' }}>{{$specialize->$name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('specializations'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('specializations') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.cader.fields.specializations_helper') }}</span>
                        </div>
                    </div>
                    

                    <div class="mt-4">
                        <label class="required" class="text-center" >{{ trans('cruds.skill.title') }}</label>
                        <hr width="70%" style="margin: 7px 0px 14px 0px;">
                        <div class="partials-scrollable">
                            @include('admin.caders.partials.skills')
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="certificates">{{ trans('cruds.user.fields.certificates') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('certificates') ? 'is-invalid' : '' }}" id="certificates-dropzone">
                        </div>
                        @if($errors->has('certificates'))
                            <div class="invalid-feedback">
                                {{ $errors->first('certificates') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.certificates_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="cv">{{ trans('cruds.user.fields.cv') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('cv') ? 'is-invalid' : '' }}" id="cv-dropzone">
                        </div>
                        @if($errors->has('cv'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cv') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.cv_helper') }}</span>
                    </div>

                    {{-- <div class="previous-experience mt-3"> 
                        <label class="required" class="text-center" >{{ trans('cruds.previous_experience.title') }}</label>
                        <button class="btn btn-info add-more-previous-experience text-right"> Add More+</button> 
                        <hr width="70%" style="margin: 7px 0px 14px 0px;">
                        <div class="partials-scrollable fields">

                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="required" for="company_name">{{ trans('cruds.previous_experience.fields.company_name') }}</label>
                                        <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"  type="text" name="company_name" id="company_name" value="{{old('company_name')}}" required> 
                                        <span class="help-block">{{ trans('cruds.previous_experience.fields.company_name_helper') }}</span>
                                        @if($errors->has('company_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('company_name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="job_type">{{ trans('cruds.previous_experience.fields.job_type') }}</label>
                                        <input class="form-control {{ $errors->has('job_type') ? 'is-invalid' : '' }}" type="text" name="job_type" id="job_type" value="{{old('job_type')}}" required>
                                        @if($errors->has('job_type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('job_type') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.previous_experience.fields.job_type_helper') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="start_date">{{ trans('cruds.previous_experience.fields.start_date') }}</label>
                                        <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{old('start_date')}}" required> 
                                        @if($errors->has('start_date'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('start_date') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.previous_experience.fields.start_date_helper') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="end_date">{{ trans('cruds.previous_experience.fields.end_date') }}</label>
                                        <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{old('end_date')}}" required> 
                                        @if($errors->has('end_date'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('end_date') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.previous_experience.fields.end_date_helper') }}</span>
                                    </div>
                                </div>
                            </div>
                                
                        </div> 
                    </div>  --}}

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
    var max_fields = 4;
    var wrapper = $(".previous-experience .fields");
    var add_button = $(".add-more-previous-experience");

    var x = 0;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $.post('{{ route('admin.caders.partials.previous_experience') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $(wrapper).append(data); //add input box
            });
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete-previous-experience", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
</script>

<script>
    Dropzone.options.photoDropzone = {
        url: '{{ route('admin.caders.storeMedia') }}',
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
    @if(isset($cader->user) && $cader->user->photo)
        var file = {!! json_encode($cader->user->photo) !!}
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
    var uploadedCertificatesMap = {}
Dropzone.options.certificatesDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="certificates[]" value="' + response.name + '">')
      uploadedCertificatesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCertificatesMap[file.name]
      }
      $('form').find('input[name="certificates[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($user) && $user->certificates)
      var files = {!! json_encode($user->certificates) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="certificates[]" value="' + file.file_name + '">')
        }
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
    Dropzone.options.cvDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
      $('form').find('input[name="cv"]').remove()
      $('form').append('<input type="hidden" name="cv" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="cv"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($cader->user) && $cader->user->cv)
      var file = {!! json_encode($cader->user->cv) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="cv" value="' + file.file_name + '">')
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