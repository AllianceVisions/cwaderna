

<label class="required">{{ trans('cruds.event.fields.specializations') }}</label> 
@php $name = 'name_'.app()->getLocale();@endphp
@foreach($specializations as $specialize)
    <div class="row">
        <div class="col-md-3">
            <input {{ $specialize->num_of_caders || old('specializations.'.$specialize->id) ? 'checked' : null }} data-id="{{ $specialize->id }}" type="checkbox" class="specialization-enable">
            {{ $specialize->$name }}
        </div> 
        <div class="col-md-4">
            <label class="required" >{{ trans('cruds.event.fields.num_of_caders') }}</label>
            <input value="{{ old('specializations.'.$specialize->id ,$specialize->num_of_caders) ?? null }}"
                    {{ $specialize->num_of_caders || old('specializations.'.$specialize->id) ? null : 'disabled' }} 
                    data-id="{{ $specialize->id }}" 
                    name="specializations[{{ $specialize->id }}][num_of_caders]" 
                    type="number" step="1" min="0" class="specialization-number form-control" placeholder="">
            <br>
            <label class="required" >{{ trans('cruds.event.fields.budget') }}</label>
            <input value="{{ old('specializations.'.$specialize->id ,$specialize->budget) ?? null }}" 
                    {{ $specialize->budget || old('specializations.'.$specialize->id) ? null : 'disabled' }} 
                    data-id="{{ $specialize->id }}" 
                    name="specializations[{{ $specialize->id }}][budget]" 
                    type="number" step="1" min="0" class="specialization-budget form-control" placeholder="">
        </div> 
        <div class="col-md-5">
            <label class="required" >{{ trans('cruds.event.fields.start_attendance') }}</label>
            <input value="{{ old('specializations.'.$specialize->id ,$specialize->start_attendance) ?? null }}" 
                    {{ $specialize->start_attendance || old('specializations.'.$specialize->id) ? null : 'disabled' }} 
                    data-id="{{ $specialize->id }}" 
                    name="specializations[{{ $specialize->id }}][start_attendance]" 
                    type="text" step="1" min="0" class="specialization-start_attendance datetime form-control" placeholder=""> 
            <br>
            <label class="required" >{{ trans('cruds.event.fields.end_attendance') }}</label>
            <input value="{{ old('specializations.'.$specialize->id ,$specialize->end_attendance) ?? null }}" 
                    {{ $specialize->end_attendance || old('specializations.'.$specialize->id) ? null : 'disabled' }} 
                    data-id="{{ $specialize->id }}" 
                    name="specializations[{{ $specialize->id }}][end_attendance]" 
                    type="text" step="1" min="0" class="specialization-end_attendance datetime form-control" placeholder="">
        </div>
        
    </div>
    <hr>
@endforeach 
@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.specialization-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.specialization-number[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.specialization-number[data-id="' + id + '"]').attr('required', enabled ? true : false)
                $('.specialization-number[data-id="' + id + '"]').val(enabled ? 1 : null)

                $('.specialization-budget[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.specialization-budget[data-id="' + id + '"]').attr('required', enabled ? true : false)
                $('.specialization-budget[data-id="' + id + '"]').val(enabled ? 1 : null)

                $('.specialization-start_attendance[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.specialization-start_attendance[data-id="' + id + '"]').attr('required', enabled ? true : false) 

                $('.specialization-end_attendance[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.specialization-end_attendance[data-id="' + id + '"]').attr('required', enabled ? true : false) 
            })
        });
    </script>
@endsection