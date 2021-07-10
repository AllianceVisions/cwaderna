@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.providerMan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.provider-men.store") }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-12">
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
                        
                        <div class="col-md-4"> 
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
                        <div class="col-md-4"> 
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
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label class="required" for="company_name">{{ trans('cruds.providerMan.fields.company_name') }}</label>
                                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                                @if($errors->has('company_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.providerMan.fields.company_name_helper') }}</span>
                            </div>
                        </div>
                        
                    </div> 

                    <div class="row">
                        
                        <div class="col-md-4"> 
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
                        <div class="col-md-4"> 
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

                        <div class="col-md-4"> 
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
                    <div class="row">
                        
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label class="required" for="commerical_reg_num">{{ trans('cruds.providerMan.fields.commerical_reg_num') }}</label>
                                <input class="form-control {{ $errors->has('commerical_reg_num') ? 'is-invalid' : '' }}" type="text" name="commerical_reg_num" id="commerical_reg_num" value="{{ old('commerical_reg_num', '') }}" required>
                                @if($errors->has('commerical_reg_num'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('commerical_reg_num') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.providerMan.fields.commerical_reg_num_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label class="required" for="working_field">{{ trans('cruds.providerMan.fields.working_field') }}</label>
                                <input class="form-control {{ $errors->has('working_field') ? 'is-invalid' : '' }}" type="text" name="working_field" id="working_field" value="{{ old('working_field', '') }}" required>
                                @if($errors->has('working_field'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('working_field') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.providerMan.fields.working_field_helper') }}</span>
                            </div>
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label class="required" for="website">{{ trans('cruds.providerMan.fields.website') }}</label>
                                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}" required>
                                @if($errors->has('website'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('website') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.providerMan.fields.website_helper') }}</span>
                            </div>
                        </div> 
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
