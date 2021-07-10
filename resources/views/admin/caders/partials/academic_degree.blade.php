


<div>
    <hr>
    
    <div class="row">
        <div class="col-md-6"> 
            <div class="form-group">
                <label class="required" for="university_name">{{ trans('cruds.academic_degree.fields.university_name') }}</label>
                <input class="form-control " type="text" name="university_name[]" id="university_name"  required> 
                <span class="help-block">{{ trans('cruds.academic_degree.fields.university_name_helper') }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="degree">{{ trans('cruds.academic_degree.fields.degree') }}</label>
                <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree[]" id="degree" required>
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.academic_degree.fields.start_date') }}</label>
                <input class="form-control date " type="text" name="start_date[]" id="start_date" required> 
                <span class="help-block">{{ trans('cruds.academic_degree.fields.start_date_helper') }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.academic_degree.fields.end_date') }}</label>
                <input class="form-control date " type="text" name="end_date[]" id="end_date" required> 
                <span class="help-block">{{ trans('cruds.academic_degree.fields.end_date_helper') }}</span>
            </div>
        </div>
    </div>
    
    <button class="btn btn-danger delete-previous-experience">Delete</button>
</div>