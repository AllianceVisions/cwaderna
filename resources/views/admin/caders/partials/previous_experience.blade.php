


<div>
    <hr>
    
    <div class="row">
        <div class="col-md-6"> 
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.previous_experience.fields.company_name') }}</label>
                <input class="form-control " type="text" name="company_name[]" id="company_name"  required> 
                <span class="help-block">{{ trans('cruds.previous_experience.fields.company_name_helper') }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="job_type">{{ trans('cruds.previous_experience.fields.job_type') }}</label>
                <input class="form-control " type="text" name="job_type[]" id="job_type"  required> 
                <span class="help-block">{{ trans('cruds.previous_experience.fields.job_type_helper') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.event.fields.start_date') }}</label>
                <input class="form-control date " type="text" name="start_date[]" id="start_date" required> 
                <span class="help-block">{{ trans('cruds.event.fields.start_date_helper') }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.event.fields.end_date') }}</label>
                <input class="form-control date " type="text" name="end_date[]" id="end_date" required> 
                <span class="help-block">{{ trans('cruds.event.fields.end_date_helper') }}</span>
            </div>
        </div>
    </div>
    
    <button class="btn btn-danger delete-previous-experience">Delete</button>
</div>