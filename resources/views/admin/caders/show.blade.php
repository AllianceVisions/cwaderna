@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cader.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.caders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            
            @php $name = 'name_'.app()->getLocale();@endphp
            
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.cader.fields.id') }}
                                </th>
                                <td>
                                    {{ $cader->user ? $cader->user->id : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.first_name') }}
                                </th>
                                <td>
                                    {{ $cader->user ? $cader->user->first_name : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.last_name') }}
                                </th>
                                <td>
                                    {{ $cader->user ? $cader->user->last_name : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.nationality') }}
                                </th>
                                <td>
                                    {{ $cader->user ? $cader->user->nationality : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.date_of_birth') }}
                                </th>
                                <td>
                                    {{ $cader->user ? $cader->user->date_of_birth : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.gender') }}
                                </th>
                                <td>
                                    {{ $cader->user ? App\Models\User::GENDER_SELECT[$cader->user->gender] : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.national_id') }}
                                </th>
                                <td>
                                    {{ $cader->user ? $cader->user->national_id : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $cader->user ? $cader->user->email : "" }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.city_id') }}
                                </th>
                                <td>
                                    {{ $cader->user->city ? $cader->user->city->$name : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.cader.fields.description') }}
                                </th>
                                <td>
                                    {{ $cader->description }}
                                </td>
                            </tr>
                            
                            <th>
                                {{ trans('cruds.cader.fields.specializations') }}
                            </th>
                            <td>
                                @foreach ($cader->specializations as $specialize)
                                    <span class="badge bg-secondary">{{$specialize->$name}}</span>
                                @endforeach
                            </td>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.phone') }}
                                </th>
                                <td>
                                    {{ $cader->user ? $cader->user->phone : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.photo') }}
                                </th>
                                <td>
                                    @if($cader->user && $cader->user->photo)
                                        <a href="{{ asset($cader->user->photo->getUrl()) }}" target="_blank" style="display: inline-block">
                                            <img src="{{ asset($cader->user->photo->getUrl('thumb')) }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.certificates') }}
                                </th>
                                <td>
                                    @if($cader->user && $cader->user->certificates)
                                        @foreach($cader->user->certificates as $key => $media)
                                            <a href="{{ asset($media->getUrl()) }}" target="_blank" style="display: inline-block">
                                                <img src="{{ asset($media->getUrl('thumb')) }}">
                                            </a>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.cv') }}
                                </th>
                                <td>
                                    @if($cader->user && $cader->user->cv)
                                        <a href="{{ asset($cader->user->cv->getUrl()) }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 mt-4">

                    <div class="mb-4">
                        <label class="text-center" >{{ trans('cruds.skill.title') }}</label>
                        <hr width="70%" style="margin: 7px 0px 14px 0px;">
                        <div class="partials-scrollable">
                            @foreach($cader->skills as $skill) 
                                <div class="progress-group">
                                    <div class="progress-group-header">
                                        <div>{{$skill->$name}}</div>
                                        <div class="ml-auto font-weight-bold">{{$skill->pivot->progress}}%</div>
                                    </div>
                                    <div class="progress-group-bars">
                                        <div class="progress progress-xs">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{$skill->pivot->progress}}%" aria-valuenow="{{$skill->pivot->progress}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> 

                    <div>
                        <label class="text-center" >{{ trans('cruds.previous_experience.title') }}</label>
                        <button class="btn btn-warning text-white add-more-previous-experience text-right" onclick="AddMore()"> Add More+</button> 
                        <hr width="70%" style="margin: 7px 0px 14px 0px;">
                        <div class="partials-scrollable">
                            <form id="previous-experience-form" method="POST" style="display: none" action="{{route('admin.caders.new_previous_experience')}}">
                                @csrf 
                                <input type="hidden" name="user_id" value="{{$cader->user_id}}">
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
                                    <div class="col-md-5">
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
                                    <div class="col-md-5">
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
                                    <div class="col-md-2"> 
                                        <label> &nbsp;</label>
                                        <input type="submit" value="Save" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                            @if($cader->user && $cader->user->previous_experience)
                                @foreach($cader->user->previous_experience as $raw)
                                    {{$raw->company_name}}
                                    <hr width="50%" style="margin: 7px 0px 14px 0px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="badge bg-info text-white" >{{ trans('cruds.previous_experience.fields.job_type') }}</label>
                                            <span>{{$raw->job_type}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="badge bg-secondary" >{{ trans('cruds.previous_experience.fields.start_date') }}</label>
                                            <span>{{$raw->start_date}}</span>

                                            <br>
                                            
                                            <label class="badge bg-secondary" >{{ trans('cruds.previous_experience.fields.end_date') }}</label>
                                            <span>{{$raw->end_date}}</span>
                                        </div> 
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="text-center" >{{ trans('cruds.academic_degree.title') }}</label>
                        <button class="btn btn-warning text-white add-more-acadmeic-degree text-right" onclick="AddMore2()"> Add More+</button> 
                        <hr width="70%" style="margin: 7px 0px 14px 0px;">
                        <div class="partials-scrollable">
                            <form id="acadmeic-degree-form" method="POST" style="display: none" action="{{route('admin.caders.new_academic_degree')}}">
                                @csrf 
                                <input type="hidden" name="user_id" value="{{$cader->user_id}}">
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label class="required" for="university_name">{{ trans('cruds.academic_degree.fields.university_name') }}</label>
                                            <input class="form-control {{ $errors->has('university_name') ? 'is-invalid' : '' }}"  type="text" name="university_name" id="university_name" value="{{old('university_name')}}" required> 
                                            <span class="help-block">{{ trans('cruds.academic_degree.fields.university_name_helper') }}</span>
                                            @if($errors->has('university_name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('university_name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required" for="degree">{{ trans('cruds.academic_degree.fields.degree') }}</label>
                                            <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree" required>
                                                <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach(App\Models\AcademicDegree::DEGREE_SELECT as $key => $label) 
                                                        <option value="{{ $key }}">{{ trans('global.academic_degree.degree.'.$key) }}</option> 
                                                    @endforeach
                                                </select>
                                            </select> 
                                            <span class="help-block">{{ trans('cruds.academic_degree.fields.degree_helper') }}</span>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="required" for="start_date">{{ trans('cruds.academic_degree.fields.start_date') }}</label>
                                            <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{old('start_date')}}" required> 
                                            @if($errors->has('start_date'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('start_date') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.academic_degree.fields.start_date_helper') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="required" for="end_date">{{ trans('cruds.academic_degree.fields.end_date') }}</label>
                                            <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{old('end_date')}}" required> 
                                            @if($errors->has('end_date'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('end_date') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.academic_degree.fields.end_date_helper') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2"> 
                                        <label> &nbsp;</label>
                                        <input type="submit" value="Save" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                            @if($cader->user && $cader->user->academic_degree)
                                @foreach($cader->user->academic_degree as $raw)
                                    {{$raw->university_name}}
                                    <hr width="50%" style="margin: 7px 0px 14px 0px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="badge bg-info text-white" >{{ trans('cruds.academic_degree.fields.degree') }}</label>
                                            <span>{{ trans('global.academic_degree.degree.'.$raw->degree) }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="badge bg-secondary" >{{ trans('cruds.academic_degree.fields.start_date') }}</label>
                                            <span>{{$raw->start_date}}</span>

                                            <br>
                                            
                                            <label class="badge bg-secondary" >{{ trans('cruds.academic_degree.fields.end_date') }}</label>
                                            <span>{{$raw->end_date}}</span>
                                        </div> 
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.caders.index') }}">
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
    function AddMore(){
        $('#previous-experience-form').css('display','inline');
    }
    function AddMore2(){
        $('#acadmeic-degree-form').css('display','inline');
    }
</script>
@endsection
